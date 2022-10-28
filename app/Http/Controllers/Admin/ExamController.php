<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Courses;
use App\Models\Exam;
use App\Models\Courseselection;
use DB;

class ExamController extends Controller
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
    //
    public function index()
    {
      $data['exam'] = Exam::all();
            
      return view('admin.exam.index',$data);
    } 
    public function create(Request $request)
    {
      $data['course'] = Courses::all();
      return view('admin.exam.create',$data);
    }
    public function store(Request $request)
    {
      $request->validate([
      'exam_name' => 'required',
      'exam_description' => 'required',
      'exam_document' => 'required | mimes:jpeg,jpg,png,pdf,doc,jpg',
      'course_id' => 'required',
      'exam_duration' => 'required'
      ]);

      $exam = new Exam;
      $exam->exam_name = $request->exam_name;
      $exam->exam_description = strip_tags($request->exam_description);
      if($request->file('exam_document')){
        $file= $request->file('exam_document');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $exam->exam_document = $filename;
      }
      $exam->course_id = $request->course_id;
      $exam->exam_duration = $request->exam_duration;
      $exam=$exam->save();
      if($exam)
      {
          Session::flash('message', 'Exam Created successfully!'); 
          Session::flash('alert-class', 'alert-success');
          return redirect()->route('exam.index');
      }
      else
      {
          Session::flash('message', 'Error during exam create!'); 
          Session::flash('alert-class', 'alert-danger');
          return redirect()->route('exam.index');
      }
    } 
    public function show($id, Request $request)
    {    
        $exam = Exam::findOrFail($id);
        $course = Courses::all();
        return view('admin.exam.show',compact('exam'),compact('course'));
       
    } 

    public function edit($id)
    {
      $exam = Exam::findOrFail($id);   
      $course = Courses::all(); 
      return view('admin.exam.edit', compact('exam'),compact('course'));
    }

    public function update(Request $request,$id)
    {
      $exam = Exam::findOrFail($id);
      $exam->exam_name = $request->exam_name;
      $exam->exam_description = strip_tags($request->exam_description);
      $exam->course_id = $request->course_id;
      if($request->file('exam_document')){
        $file= $request->file('exam_document');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $exam->exam_document= $filename;
      }
      $exam->exam_duration = $request->exam_duration;
      $exam=$exam->save();
      if($exam)
      {
        Session::flash('message', 'Exam updated successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('exam.index');
      }
      else
      {
        Session::flash('message', 'Error during  assignment update!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('assignment.index');
      }
    }

    public function destroy($id)
    {
      $exam = Exam::destroy($id);  
      if($exam)
      {
        Session::flash('message', 'Exam Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('exam.index');
      }
      else
      {
        Session::flash('message', 'Error during exam delete!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('exam.index');
      }   
    }
}
