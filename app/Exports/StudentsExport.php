<?php

namespace App\Exports;

use DB;
use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $students = DB::table('students')
                    ->leftJoin('enrollments','students.enrollment_id','=','enrollments.id')
                    ->leftJoin('parentts','enrollments.id','=','parentts.enrollment_id')
                     ->select(
                        'enrollments.surname as surname',
                        'enrollments.other_names as other_names',
                        'enrollments.gender as gender',
                        'enrollments.dob as dob',
                        'enrollments.former_sch as former_sch',
                        'enrollments.former_sch as former_sch_class',
                        'enrollments.nationality as nationality',
                        'enrollments.state as state',
                        'enrollments.lga as lga',
                        'enrollments.town as town',
                        'enrollments.village as village',
                        'enrollments.home_address as home_address',
                        'enrollments.emergency_contact as emergency_contact',
                        'enrollments.emergency_phone as emergency_phone',
                        'enrollments.ailment as ailment',
                        'enrollments.siblings as siblings',
                        'enrollments.seeking_admission_into as seeking_admission_into',
                        
                        // Parent
                        'parentts.fullname as parent_surname',
                        'parentts.relation as parent_relation',
                        'parentts.phone as parent_phone',
                        'parentts.home_address as parent_home_address',
                        'parentts.occupation as parent_occupation',
                        'parentts.business_address as parent_business_address',
                        'enrollments.parents_email as parents_email',
                        // Admission
                        'students.classroom_id as admitted_into'
                        

                 )->get();

                 return $students;
    }
    public function headings(): array
    {
        return [
            'surname',
            'other_names',
            'gender',
            'dob',
            'former_sch',
            'former_sch_class',
            'nationality',
            'state_of_origin',
            'lga',
            'town',
            'village',
            'home_address',
            'emergency_contact',
            'emergency_phone',
            'ailment',
            'siblings',
            'seeking_admission_into',

            // parent

            'parent_fullname',
            'parent_relation',
            'parent_phone',
            'parent_home_address',
            'parent_occupation',
            'parent_business_address',
            'parents_email',

            'admitted_into'
        ];
    }
}
