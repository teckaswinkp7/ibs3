<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Exam;
use App\Models\User;
use App\Models\Courses;
use App\Models\Courseselection;
use DB;
class StudentExamController extends Controller
{
    //
    public function index(Request $request)
    { 
        
      $id = Auth::id();
      $user = User::where('id', $id)->get();
      $exam= DB::table('exams')
      ->leftjoin('courseselections','courseselections.studentSelCid', 'exams.course_id' )
      ->leftjoin('courses','courses.id', 'exams.course_id' )
      ->leftjoin('users','users.id', 'courseselections.stu_id' )
      ->where('courseselections.stu_id', $id)
      ->get(['exams.id','exams.exam_name','exams.exam_description','exams.exam_duration','exams.course_id']); 


  //  $exam = Exam::with(relations:'courses')->get();

     // print_r($exam);
     // die();
    
    
      return view('front.studentexam.index',compact('exam'));
    }
    public function show($id)
    {   
        $exam = Exam::findOrFail($id);   
        $course = Courses::all();
        return view('front.studentexam.show', compact('exam'),compact('course'));
    }
}
