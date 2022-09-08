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
use App\Models\Courseselection;
use App\Mail\OfferEmail;
use Illuminate\Support\Facades\Mail;
use Hash;
use DB;
class StudentcourseController extends Controller
{
    //
    public function index()
    {
        $data = User::join('courseselections', 'courseselections.stu_id', '=', 'users.id')
        ->where('courseselections.offer_generated', '=', 0)
        ->get(['users.*','courseselections.studentSelCid']);
               
        return view('admin\stucourse.index', compact('data'));         
    }

    public function courseoffer($id)
    {
        //dd($id);
        //$users = User::where('user_role',2)->where('status',5)->get();
        $users = User::where('id',$id)->get();
        //dd($users);
        //$uid=$users[0]->id;
        $uid=(int) $id;
        //dd($uid);
        //DB::enableQueryLog();
        $student_course_offer= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id", 
            "courses.name as courses_name",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->where('studentcourses.stu_id','=',$uid)
        ->get(); 
        //dd(student_course_offer);
        
        // $query = DB::getQueryLog();
        // dd($query);
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
        //$id = 10;
        //$status = User::where('id', $id)->update(array('status' => 6));
        $status = Courseselection::where('stu_id', $id)->update(array('offer_generated' => 1));
        $data = array('offer_desc'=>"$request->course_offer_description",'offer'=> $offer);  
        Mail::to($request->stu_email)->send(new OfferEmail($data));
        //Mail::to('vedmanimoudgal@virtualemployee.com')->send(new OfferEmail($data));
        return redirect('admin/studentcourse');
        //->with('success','created successfully.');
    }
}
