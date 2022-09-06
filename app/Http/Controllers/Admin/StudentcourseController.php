<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Courses;
use App\Models\Studentcourse;
use App\Models\Studentcourseoffer;
use App\Mail\OfferEmail;
use Illuminate\Support\Facades\Mail;
use Hash;
class StudentcourseController extends Controller
{
    //
    public function index()
    {
        $users = User::where('user_role',2)->where('status',5)->get();
        if($users->isEmpty()){
            return view('admin\stucourse.index');
        }
        else{
        $uid=$users[0]->id;
        $student_course = Studentcourse::select(
        "studentcourses.student_course_id", 
        "studentcourses.stu_id", 
        "courses.name as courses_name"
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")->where('studentcourses.stu_id','=',$uid)
        ->get();    
        return view('admin\stucourse.index',compact('student_course','users'));  
        }        
    }
    public function courseoffer()
    {
        $users = User::where('user_role',2)->where('status',5)->get();
        $uid=$users[0]->id;
        $student_course_offer= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id", 
            "courses.name as courses_name",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->where('studentcourses.stu_id','=',$uid)
        ->get(); 
        return view('admin\stucourse.courseoffer',compact('student_course_offer','users'));
    }
    public function store(Request $request)
    {
        $offer = new Studentcourseoffer;
        $course_offer = $request->all();
        $offer=$request->course_offer_description;
        $course_offer=Studentcourseoffer::create([
            'stu_id'         => $request->stu_id,
            'offer_course_id'    => $request->offer_course_id,
            'course_offer_description'    => $request->course_offer_description,
        ]);
        $id=$request->stu_id;
        $status = User::where('id', $id)->update(array('status' => 6));
        $data = array('offer_desc'=>"$request->course_offer_description",'offer'=> $offer);  
        Mail::to($request->stu_email)->send(new OfferEmail($data));
        return redirect()->route('stucourse.index')
        ->with('success','created successfully.');
    }
}
