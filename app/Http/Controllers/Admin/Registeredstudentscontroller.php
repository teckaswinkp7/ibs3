<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Education;
class Registeredstudentscontroller extends Controller
{
    public function index(){

        $data1['role']= Role::all();
        $registeredstudents = User::where('user_role', 2) 
        
        ->get();

        return view('admin.reports.registeredstudents',$data1,compact('registeredstudents'));
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */

    public function show(Request $request,$id)
    {
    //$role = Role::all();
    
    $user = User::findOrFail($id);
    $student_edu = Education::where('stu_id',$id)->get();          
    return view('admin.reports.show',compact('user','student_edu'));
    } 
}
