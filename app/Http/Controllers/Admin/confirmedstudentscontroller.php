<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;
use App\Models\Education;
use App\Models\Courseselection;
use App\Models\Studentcourse;
use App\Models\Role;
use DB;

class confirmedstudentscontroller extends Controller
{
    public function index(){

        $data1['role']= Role::all();
        $confirmedstudents =  DB::table('users')
        ->select('users.id','users.name','users.email')
        ->join('courseselections','stu_id','=','users.id')
        ->where(['offer_accepted' => '1' ])
        ->get();

       

        return view('admin.reports.confirmedstudents',$data1,compact('confirmedstudents'));
    }

    public function confirmedshow(Request $request,$id)
    {
    //$role = Role::all();
    $selectedcourse= DB::table('courseselections')
        ->select('courses.name as courses_name')
        ->join("courses", "courses.id", "=", "courseselections.studentSelCid")
        ->where(['courseselections.stu_id' => $id])
        ->get();         
    $user = User::findOrFail($id);
    $student_edu = Education::where('stu_id',$id)->get();          
    return view('admin.reports.confirmedshow',compact('user','student_edu','selectedcourse'));
    } 
}
