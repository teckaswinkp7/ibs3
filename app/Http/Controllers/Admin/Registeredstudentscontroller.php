<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Education;
class Registeredstudentscontroller extends Controller
{
    public function __construct() {       
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->user_role;
            if($this->id != 1)
            {
                return redirect('unauthorized');
                die();
            }
            else{
                return $next($request);
            }
            
        });
    }

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
