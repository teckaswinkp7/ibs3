<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Assignment;
use App\Models\User;
use DB;
class StudentAssignmentController extends Controller
{
    //
    public function index()
    {

      $id = Auth::id();
      $user = User::where('id', $id)->get();
      /*$assignment = DB::table('assignments')
      ->leftjoin('courseselections','courseselections.studentSelCid', 'assignments.course_id' )
      ->leftjoin('courses','courses.id', 'assignments.course_id' )
      ->leftjoin('users','users.id', 'courseselections.stu_id' )
      ->where('courseselections.stu_id', $id)
      ->get(['assignments.id','assignments.assignment_title','assignments.assignment_description','assignments.assignment_submission_date','assignments.status']); 
      */
    //  print_r($assignment);
    //  die();
    $assignment = Assignment::all();


      return view('front.assignment.index',compact('assignment'));
    }
}
