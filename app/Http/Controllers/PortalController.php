<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Setting;

use Illuminate\Http\Request;

class PortalController extends Controller
{
  public function __construct(){
    $this->middleware('admin');
 }
    
  public function editSettings(){
    return view('setting.portal'); 
  }

  public function updateSettings(Request $request){
   $this->validate($request,[
     'academic_session' => ['required'],
   ]);
   
   $settings = Setting::findorfail(1);
   $settings->term_id = $request->academic_session;
   $settings->save();

   return redirect()->route('dashboard')->with('success','Settings saved');
  }

  public function editGrading(){
      return view('setting.grade')->with('grades',Grade::orderby('alphabet','ASC')->get());
  }

  public function updateGrading(Request $request){
     
        $grades = Grade::all();
        $rules = array();
        foreach($grades as $grade){

          $rules[$grade->alphabet.'_min'] = ['required','numeric'];
          $rules[$grade->alphabet.'_max'] = ['required','numeric'];
        }
        $this->validate($request,$rules);

        foreach($grades as $grade){
            $min = $grade->alphabet.'_min';
            $max = $grade->alphabet.'_max';
            $grade->min = $request->$min;
            $grade->max = $request->$max;
            $grade->save();
          }

        return redirect()->route('grade.settings.edit')->with('success','Grading system updated!');
      }
    
    
}
