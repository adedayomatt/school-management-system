<?php
namespace App\Fallback;

use App\Enrollment;
use App\Parentt;
use App\Student;

class ImportStudents{
    public $collections;

    public function __construct($collections){
        $this->collections = $collections;
    }

    public function import()
    {           
       
        foreach($this->collections as $row)
        { 
            if(!$this->alreadyExist($row)){

                $enrollment = Enrollment::create([
                    
                    'surname' => $row['surname'],
                    'other_names' => $row['other_names'],
                    'dob' => $this->toPHPdate($row['dob']),
                    'gender' => $row['gender'],
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
                        // 'home_address' => $this->checkForString($row['father_home_address']),
                        // 'occupation' => $this->checkForString($row['father_occupation']),
                        // 'business_address' => $this->checkForString($row['father_business_address']),
                    ]);
                   

                }
                if(isset($row['mother_fullname']) && $this->isFilled($row['mother_fullname']))
                {
                    $mother = Parentt::create([
                        'enrollment_id' => $enrollment->id,
                        'fullname' => $row['mother_fullname'],
                        'relation' => 'mother',
                        'phone' => $row['mother_phone'],
                        // 'home_address' => $this->checkForString($row['mother_home_address']),
                        // 'occupation' => $this->checkForString($row['mother_occupation']),
                        // 'business_address' => $this->checkForString($row['mother_business_address']),
                    ]);
                     
                }
                
                if($this->isFilled($row['admitted_into']) && $row['admitted_into'] > 0 ){
                   $student = Student::create([
                        'enrollment_id' => $enrollment->id,
                        'classroom_id' => $row['admitted_into']
                    ]);
                   
                }

            }
        }
    }

    private function toPHPdate($excel_date){
        // https://stackoverflow.com/questions/11119631/excel-date-conversion-using-php-excel
        if(is_numeric($excel_date)){
            $UNIX_DATE = ($excel_date - 25569) * 86400;
            return date('Y-m-d',$UNIX_DATE);
        }
        else{
            return '1899-12-31';
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
        if(Enrollment::where('surname',$row['surname'])->where('other_names',$row['other_names'])->count() > 0 )
        {
            return true;
        }
        return false;
    }
}
?>