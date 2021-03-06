<?php

namespace App\Imports;

use App\Student;
use App\Parentt;
use App\Enrollment;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {           

        foreach($rows as $row)
        { 
            if(!$this->alreadyExist($row)){

                $enrollment = Enrollment::create([
                    
                    'surname' => $row['surname'],
                    'other_names' => $row['other_names'],
                    'dob' => $this->toPHPdate($row['dob']),
                    'gender' => $row['gender'],
                    'home_address' => $row['home_address'],
                    'nationality' => $row['nationality'],
                    'state' => $row['state_of_origin'],
                    'lga' => $row['lga'],
                    'town' => $row['town'],
                    'village' => $row['village'],
                    'admitted_into' => $this->isFilled($row['admitted_into']) && $row['admitted_into'] > 0 ? $row['admitted_into'] : null,
                    'src' => 'import',
                    ]);
                                   


                if(isset($row['father_fullname']) && $this->isFilled($row['father_fullname']))
                {
                    $father = Parentt::create([
                        'enrollment_id' => $enrollment->id,
                        'fullname' => $row['father_fullname'],
                        'relation' => 'father',
                        'phone' => $row['father_phone'],
                    ]);
                   

                }
                if(isset($row['mother_fullname']) && $this->isFilled($row['mother_fullname']))
                {
                    $mother = Parentt::create([
                        'enrollment_id' => $enrollment->id,
                        'fullname' => $row['mother_fullname'],
                        'relation' => 'mother',
                        'phone' => $row['mother_phone'],
                    ]);
                     
                }
                
                if($this->isFilled($row['admitted_into']) && $row['admitted_into'] > 0 ){
                   $student = Student::create([
                        'enrollment_id' => $enrollment->id,
                        'classroom_id' => $row['admitted_into']
                    ]);
                   
                }

            }else{
                $enrollment = Enrollment::where('surname',$row['surname'])->where('other_names',$row['other_names'])->first();
                $enrollment->dob = $this->toPHPdate($row['dob']);
                $enrollment->gender = $row['gender'];
                $enrollment->home_address = $row['home_address'];
                $enrollment->nationality = $row['nationality'];
                $enrollment->state = $row['state_of_origin'];
                $enrollment->lga = $row['lga'];
                $enrollment->town = $row['town'];
                $enrollment->village = $row['village'];
                $enrollment->admitted_into = $this->isFilled($row['admitted_into']) && $row['admitted_into'] > 0 ? $row['admitted_into'] : null;
                $enrollment->src = 'import';
                $enrollment->save();

                if($enrollment->parents->count() > 0){
                    foreach($enrollment->parents as $parent){
                        if($parent->relation == 'mother'){
                            $parent->fullname = $row['mother_fullname'];
                            $parent->phone = $row['mother_phone'];
                            $parent->save();
                        }
                        else if($parent->relation == 'father'){
                            $parent->fullname = $row['father_fullname'];
                            $parent->phone = $row['father_phone'];
                            $parent->save();
                        }
                    }
                }else{
                    $father = Parentt::create([
                        'enrollment_id' => $enrollment->id,
                        'fullname' => $row['father_fullname'],
                        'relation' => 'father',
                        'phone' => $row['father_phone'],
                    ]);

                    $mother = Parentt::create([
                        'enrollment_id' => $enrollment->id,
                        'fullname' => $row['mother_fullname'],
                        'relation' => 'mother',
                        'phone' => $row['mother_phone'],
                    ]);
                }
            }
        }
    }

 public function headingRow(): int
    {
        return 1;
    }

    private function toPHPdate($excel_date){
        // https://stackoverflow.com/questions/11119631/excel-date-conversion-using-php-excel
        if(is_numeric($excel_date)){
            $UNIX_DATE = ($excel_date - 25569) * 86400;
            return date('Y-m-d',$UNIX_DATE);
        }
        else{
            return null;
        }
    }

    private function isFilled($cell){
        return $cell === null || $cell === '' ? false  : true;
    }

    private function checkForString($cell){
        return $cell === null || $cell === '' ? 'n/a' : $cell;
    }

    private function checkForInt($cell){
        return $cell === null || $cell === '' || !is_numeric($cell) ? 0 : $cell;
   
    }
    private function alreadyExist($row){
        if(Enrollment::where('surname',$row['surname'])->where('other_names',$row['other_names'])->get()->count() > 0 )
        {
            return true;
        }
        return false;
    }
}
