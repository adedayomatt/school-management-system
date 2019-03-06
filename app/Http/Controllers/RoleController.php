<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
        $this->middleware('nofeature')->except(['index','show']);
     }

     public function getRole($id){
        if(is_numeric($id)){
            return Role::findorfail($id);
        }
        elseif(is_string($id)){
            return Role::where('slug',$id)->firstorfail();
        }
     }
     	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index')->with('roles',Role::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
			'name' =>'required|max:50',
		]);

		$role = Role::create([
			'name' => $request->name,
			'slug'=>str_slug($request->name)
		]);

		return redirect()->route('role.index')->with('success','New staff role added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $role = $this->getRole($slug);
        return view('role.show')->with('role',$role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $role = $this->getRole($slug);
        return view('role.edit')->with('role',$role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'name' =>'required|max:50',
        ]);
        
        $role = $this->getRole($slug);
        $role->name = $request->name;
        $role->slug = str_slug($request->salary);
        $role->save();

		return redirect()->route('roles.show',$role->slug)->with('success',$role->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->getRole($slug);
		foreach($role->staff as $stf){
			$stf->forceDelete();
        }
        
		$role->delete();
		return redirect()->route('role.index')->with('success','Staff role '.$role->name.' deleted');
    }
} 
