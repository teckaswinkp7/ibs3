<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Assignment;
use App\Models\Courses;
class AssignmentController extends Controller
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
      $data['assignment'] = Assignment::all();
      return view('admin.assignment.index',$data);
    }

    public function create(Request $request)
    {
      $data['course'] = Courses::all();
      return view('admin.assignment.create',$data);
    }

    public function store(Request $request)
    {
      $request->validate([
      'assignment_title' => 'required',
      'assignment_description' => 'required',
      'assignment_document' => 'required | mimes:jpeg,jpg,png,pdf,doc,jpg',
      'course_id' => 'required',
      'assignment_submission_date' => 'required',
      ]);

      $assignment = new Assignment;
      $assignment->assignment_title = $request->assignment_title;
      $assignment->assignment_description = strip_tags($request->assignment_description);
      if($request->file('assignment_document')){
        $file= $request->file('assignment_document');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $assignment->assignment_document= $filename;
      }
      $assignment->course_id = $request->course_id;
      $assignment->assignment_submission_date = $request->assignment_submission_date;
      $assignments=$assignment->save();

      if($assignments)
      {
        Session::flash('message', 'Assignment Created successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('assignment.index');
      }
      else
      {
        Session::flash('message', 'Error during  assignment create!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('assignment.index');
      }
    
    }

    public function show($id, Request $request)
    {
        $assignment = Assignment::findOrFail($id);
        return view('admin.assignment.show',compact('assignment'));
       
    } 

    public function edit($id)
    {
      $assignment = Assignment::findOrFail($id);   
      $course = Courses::all(); 
      return view('admin.assignment.edit', compact('assignment'),compact('course'));
    }

    public function update(Request $request,$id)
    {
      $assignment = Assignment::findOrFail($id);
      $assignment->assignment_title = $request->assignment_title;
      $assignment->assignment_description = strip_tags($request->assignment_description);
      if($request->file('assignment_document')){
        $file= $request->file('assignment_document');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $assignment->assignment_document= $filename;
      }
      $assignment->course_id = $request->course_id;
      $assignment->assignment_submission_date = $request->assignment_submission_date;
      $assignments=$assignment->save();
      if($assignments)
      {
        Session::flash('message', 'Assignment updated successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('assignment.index');
      }
      else
      {
        Session::flash('message', 'Error during  assignment update!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('assignment.index');
      }
      return redirect()->route('assignment.index')->with('success','Assignment Has Been updated successfully');   
    }

    public function destroy($id)
    {
      $assignment = Assignment::destroy($id);  
      if($assignment)
      {
        Session::flash('message', 'Assignment Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('assignment.index');
      }
      else
      {
        Session::flash('message', 'Error during assignment delete!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('assignment.index');
      }   
    }
}
