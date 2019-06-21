<?php
namespace App\Http\Controllers;
use Artisan;
use Log;
use Storage;
use Session;
use App\Http\Requests;

class BackupController extends Controller
{
    public $disk;
    public $folder;

    public function __construct(){
        $this->disk = config('backup.backup.destination.disks')[0];
        $this->folder = config('backup.backup.name');
    }
    // return all the backup files
    private function getBackups(){
        $disk = Storage::disk($this->disk);
        $files = $disk->files($this->folder);
        $backups = [];
       // make an array of backup files, with their filesize and creation date
       foreach ($files as $k => $f) {
           // only take the zip files into account
           if (substr($f, -4) == '.zip' && $disk->exists($f)) {
               $timeDifference = ageFrom($disk->lastModified($f));
               $age = $timeDifference->m > 0 ? $timeDifference->m.' Mnths, ' : '';
               $age .= $timeDifference->d > 0 ? $timeDifference->d.' Days, ' : '';
               $age .= $timeDifference->h > 0 ? $timeDifference->h.' Hrs, ' : '';
               $age .= $timeDifference->i.' mins';
               $backups[] = [
                   'file_path' => $f,
                   'file_name' => str_replace($this->folder . '/', '', $f),
                   'file_size' => $disk->size($f),
                   'last_modified' => $disk->lastModified($f),
                   'age' => $age
               ];
           }
       }

       // reverse the backups, so the newest one would be on top
       $backups = array_reverse($backups);
       return $backups;
    }
    public function index()
    {
        return view("backups")->with('backups', $this->getBackups());
    }
    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);

            Session::flash('success','New backup created');
            //download the latest backup now;
           return $this->download($this->getBackups()[0]['file_name']);

        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = $this->folder . '/' . $file_name;
        $disk = Storage::disk($this->disk);
        if ($disk->exists($file)) {
            $fs = Storage::disk($this->disk)->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk($this->disk);
        if ($disk->exists($this->folder . '/' . $file_name)) {
            $disk->delete($this->folder . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}