<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
class AssignmentsubmissionController extends Controller
{
    //
    public function index()
    {
      
      return view('front.assignment.index');
    }
    public function submit($id)
    {
        $assignmentsubmit = Assignment::findOrFail($id);   
        return view('front.assignment.assignmentsubmission', compact('assignmentsubmit'));
    }

    public function store(Request $request)
    {
      $request->validate([
      'assignment_submission_description' => 'required',
      'assignment_submission_document' => 'required | mimes:jpeg,jpg,png,pdf,doc,jpg'
      ]);

      $assignmentsubmission = new AssignmentSubmission;
      $assignmentsubmission->stu_id = Auth::id();
      $assignmentsubmission->assignment_id = $request->assignment_id;
      $assignmentsubmission->assignment_submission_description = $request->assignment_submission_description;
      if($request->file('assignment_submission_document')){
        $file= $request->file('assignment_submission_document');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $assignmentsubmission->assignment_submission_document= $filename;
      }
      $assignmentsubmission->assignmentsubmission_date = date("Y-m-d");
      $assignmentsubmission =$assignmentsubmission ->save();

      if($assignmentsubmission)
      {
        Assignment::where('id', $request->assignment_id)->update(['status' => 1]);
        Session::flash('message', 'Assignment Created successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('studentassignment.index');
      }
      else
      {
        Session::flash('message', 'Error during  assignment create!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('studentassignment.index');
      }
    
    }


}
