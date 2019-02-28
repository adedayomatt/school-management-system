<?php

namespace App\Imports;

use App\Staff;
use App\Guarantor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StaffsImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row)
        {
                $staff = Staff::create([ 
                'surname' => $this->checkForString($row['surname']),
                'other_names' => $this->checkForString($row['other_names']),
                'gender' => $this->checkForString($row['gender']),
                'dob' => $this->toPHPdate($row['dob']),
                'marital_status' => $this->checkForString($row['marital_status']),
                'phone' => $this->checkForString($row['phone']),
                'email' => $this->checkForString($row['email']),
                'first_appointment' => $this->toPHPdate($row['first_appointment']),
                'nationality' => $this->checkForString($row[ 'nationality']),
                'state' => $this->checkForString($row['state']),
                'lga' => $this->checkForString($row['lga']),
                'town' => $this->checkForString($row['town']),
                'village' => $this->checkForString($row['village']),
                'permanent_address' => $this->checkForString($row['permanent_address']),
                'residential_address' => $this->checkForString($row['residential_address']),
                'emergency_contact' => $this->checkForString($row['emergency_contact']),
                'role_id' =>  $row['role_id'] === null || $row['role_id'] === '' || !is_numeric($row['role_id']) ? 2 : $row['role_id'],
                'src' => 'import'
                ]);
                if(
                $this->isFilled($row['guarantor_surname']) &&
                 $this->isFilled($row['guarantor_other_names']) && 
                 $this->isFilled($row['guarantor_phone'])
                )
                //If guarantor exist 
                {
                    $guarantor = Guarantor::create([
                        'staff_id' => $staff->id,
                        'surname' => $row['guarantor_surname'],
                        'other_names' => $row['guarantor_other_names'],
                        'gender' => $this->checkForString($row['guarantor_gender']),
                        'marital_status' => $this->checkForString($row['guarantor_marital_status']),
                        'phone' => $this->checkForString($row['guarantor_phone']),
                        'email' => $this->checkForString($row['guarantor_email']),
                        'business_address' => $this->checkForString($row['guarantor_business_address']),
                        'home_address' => $this->checkForString($row['guarantor_home_address']),
                        'nationality' => $this->checkForString($row['guarantor_nationality']),
                        'employer' => $this->checkForString($row['guarantor_employer']),
                        'years_with_employer' => $this->checkForInt($row['guarantor_years_with_employer'])
                    ]);
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


}
