<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use App\Models\AssignmentGrade;
class AssignmentGradeController extends Controller
{
    public function __construct() {       
              
      $this->middleware('auth');
      $this->middleware(function ($request, $next) {
          $this->id = Auth::user()->user_role;
          if($this->id != 1)
          {
              echo 'Unautohorized Access';
              die();
          }
          else{
              return $next($request);
          }          
      });
    }
    //
    public function index()
    {
      $data['assignmentsub'] = AssignmentSubmission::join('Assignments', 'assignments.id', '=', 'assignment_submissions.assignment_id')
      ->get(['assignment_submissions.*', 'assignments.assignment_title']);
      return view('admin.assignmentgrade.index',$data);
    }
    public function grade($id)
    {
      $data['assignmentsub'] = AssignmentSubmission::findOrFail($id);
      return view('admin.assignmentgrade.grade',$data);
    }
    public function store(Request $request)
    {
      $request->validate([
      'assignment_grade_percentage' => 'required',
      
      ]);

      $assignmentsubmission_grade = new AssignmentGrade;
      $assignmentsubmission_grade->stu_id = $request->stu_id;
      $assignmentsubmission_grade->assignment_id = $request->assignment_id;
      $assignmentsubmission_grade->grade_id = 2;
      $assignmentsubmission_grade->assignment_grade_percentage = $request->assignment_grade_percentage;
      $assignmentsubmission_grade_sub =$assignmentsubmission_grade ->save();

      if($assignmentsubmission_grade_sub)
      {
        Session::flash('message', 'Assignment Grade  submitted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('assignmentgrade.index');
      }
      else
      {
        Session::flash('message', 'Error during  grade submit create!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('assignmentgrade.index');
      }
    
    }

}
