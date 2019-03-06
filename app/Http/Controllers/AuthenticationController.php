<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use App\Staff;
use App\Events\StaffAuthorization;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
  public function __construct(){
    $this->middleware('superadmin2')->except([
      'maintainance',
      'deniedAccess',
      'editPassword',
      'updatePassword'
    ]);
 }
 public function maintainance(){
        return view('pages.maintainance');
      }

    public function deniedAccess(){
    if(Auth::user()->hasAccess()){
        return redirect()->route('dashboard');
    }
    return view('pages.access-denied');
    }
    
    private function auth(array $data){
        return User::create([
            'email' => $data['email'],
            'status' => $data['status'],
            'password' => bcrypt($data['password']),
        ]);
    }

    private function generatePassword(){
        $hash = Hash::make(time());
        return substr($hash, 10,7);
    }

    private function isAuthorizable($email){
        $e = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($e, FILTER_VALIDATE_EMAIL) ? true : false;
    }
    
    public function editPassword(){
        return view('setting.password'); 
      }
  
      public function updatePassword(Request $request){
        $user = Auth::user();
        $this->validate($request,[
          'old_password' => 'required',
          'password' => 'required|string|min:6|confirmed'
      ]);
      if(Hash::check($request->old_password, $user->password)){
          $user->password = Hash::make($request->password);
          $user->save();
          return redirect()->route('dashboard')->with('success','Password changed');
      }
    else{
        return redirect()->back()->with('error','Old password not correct');
    }
  }

  public function authorizeStaff($id){
    //  return redirect()->back()->with('warning','Staff authorization is not enabled yet');
    
    $staff = Staff::findorfail($id);
    if($staff->isAsstTeacher()){
      return redirect()->back()->with('warning','Authorization for assistant teachers is enabled');
    }
    if(User::where('email',$staff->email)->get()->count() > 0){
        return redirect()->back()->with('error', 'Could not authorize '.$staff->fullname().'. Email '.$staff->email.' is already authorized for a user');
    }
    
    if(!$this->isAuthorizable($staff->email)){
     return redirect()->back()->with('error','Could not authorize '.$staff->fullname().'. Email could be invalid');
    }
    $password = $this->generatePassword();

    $auth = $this->auth([
        'email' => $staff->email,
        'status' => 'staff',
        'password' => $password
    ]);

    $staff->user_id = $auth->id;
    $staff->save();

    event(new StaffAuthorization($staff,$password));

    return redirect()->route('staff.show',[$staff->id])->with('success',$staff->fullname().' authorized!');

  }

  public function reAuthorizeStaff($id){
    $staff = Staff::findorfail($id);
    $user = User::findorfail($staff->user_id);
    $user->password = $this->generatePassword();
    $user->save();

    event(new StaffAuthorization($staff,$password));

    return redirect()->route('staff.show',[$staff->id])->with('success',$staff->fullname().' reauthorized!');

  }

  public function revokeAccess($id){
    $staff = Staff::findorfail($id);
    $user = $staff->user;
    $user->access = 0;
    $user->save();

    return redirect()->back()->with('success',$staff->fullname().' access to the portal revoked!');
  }

  public function restoreAccess($id){
    $staff = Staff::findorfail($id);
    $user = $staff->user;
    $user->access = 1;
    $user->save();

    return redirect()->back()->with('success',$staff->fullname().' access to the portal restored!');
  }

}
