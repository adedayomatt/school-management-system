<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StaffExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $staff = DB::table('staff')
                    ->leftJoin('guarantors','staff.id','=','guarantors.staff_id')
                    ->select(
                        'staff.surname as surname',
                        'staff.other_names as other_names',
                        'staff.gender as gender',
                        'staff.dob as dob',
                        'staff.marital_status as marital_status',
                        'staff.phone as phone',
                        'staff.email as email',
                        'staff.first_appointment as first_appointment',
                        'staff.nationality as nationality',
                        'staff.state as state',
                        'staff.lga as lga',
                        'staff.town as town',
                        'staff.village as village',
                        'staff.permanent_address as permanent_address',
                        'staff.residential_address as residential_address',
                        'staff.emergency_contact as emergency_contact',
                        'staff.role_id as role_id',

                        // Guarantor
                        'guarantors.surname as guarantor_surname',
                        'guarantors.other_names as guarantor_other_names',
                        'guarantors.gender as guarantor_gender',
                        'guarantors.marital_status as guarantor_marital_status',
                        'guarantors.phone as guarantor_phone',
                        'guarantors.email as guarantor_email',
                        'guarantors.nationality as guarantor_nationality',
                        'guarantors.home_address as guarantor_home_address',
                        'guarantors.business_address as guarantor_business_address',
                        'guarantors.employer as guarantor_employer',
                        'guarantors.years_with_employer as guarantor_years_with_employer',

                 )->get();

        return $staff;
        
    }
    public function headings(): array
    {
        return [
            'surname',
            'other_names',
            'gender',
            'dob',
            'marital_status',
            'phone',
            'email',
            'first_appointment',
            'nationality',
            'state',
            'lga',
            'town',
            'village',
            'permanent_address',
            'residential_address',
            'emergency_contact',
            'role_id',

            'guarantor_surname',
            'guarantor_other_names',
            'guarantor_gender',
            'guarantor_marital_status',
            'guarantor_phone',
            'guarantor_email',
            'guarantor_nationality',
            'guarantor_home_address',
            'guarantor_business_address',
            'guarantor_employer',
            'guarantor_years_with_employer'

        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return "staff";
    }

}
