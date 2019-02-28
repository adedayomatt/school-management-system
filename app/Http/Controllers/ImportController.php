<?php

namespace App\Http\Controllers;

use App\Imports\StaffsImport;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
     }
     
    public function staffForm(){
        return view('import.staff');
    }

    public function importStaff(){
        Excel::import(new StaffsImport,request()->file('file'));
        return back()->with('success','Staff records imported');
    }    

    public function studentForm(){
        return view('import.students');
    }
    public function importStudents(){
        Excel::import(new StudentsImport,request()->file('file'));
        return back()->with('success','Students records imported');
    }    

}
