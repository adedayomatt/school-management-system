<?php

namespace App\Http\Controllers;

use App\Exports\StaffExport;
use App\Exports\StudentsExport;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
     }

    public function staff(){
        return Excel::download(new StaffExport, 'staff.xlsx');
    }
    
    public function students(){
        return Excel::download(new StudentsExport, 'students.xlsx');
    }
}
