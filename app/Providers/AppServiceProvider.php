<?php

namespace App\Providers;

use DB;
use App\Fee;
use App\Role;
use App\Staff;
use App\Student;
use App\Subject;
use App\Payment;
use App\Classroom;
use App\Enrollment;
use App\Setting;
use App\Term;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any enrollment services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);
      $enrollments = Enrollment::all();
      $pending_enrollments = array();
        foreach($enrollments as $e){
            if($e->student == null){
                array_push($pending_enrollments,$e);
            }
        }
      View::share([
        '_classes' => Classroom::class,
        '_subjects' => Subject::class,
        '_staffs' => Staff::class,
        '_students' => Student::class,
        '_roles' => Role::class,
        '_fees' => Fee::class,
        '_payments' => Payment::class,
        '_enrollments' => enrollment::class,
        '_pending_enrollments' => collect($pending_enrollments),
        '_settings' => Setting::all()->first(),
        '_terms' => Term::class 
    ]);
    }

    /**
     * Register any enrollment services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
