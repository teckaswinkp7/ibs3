<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Grade;
class GradeController extends Controller
{
    //
    public function index()
    {
      $data['grade'] = Grade::all();
      return view('admin.grade.index',$data);
    }
    public function create(Request $request)
    {
      return view('admin.grade.create');
    }
    public function store(Request $request)
    {
      $request->validate([
      'grade_name' => 'required',
      'grade_min_percentage' => 'required',
      'grade_max_percentage' => 'required'
      ]);

      $grade = new Grade;
      $grade->grade_name = $request->grade_name;
      $grade->grade_min_percentage = $request->grade_min_percentage;
      $grade->grade_max_percentage = $request->grade_max_percentage;
      $grades=$grade->save();
      if($grades)
      {
          Session::flash('message', 'Grade Created successfully!'); 
          Session::flash('alert-class', 'alert-success');
          return redirect()->route('grade.index');
      }
      else
      {
          Session::flash('message', 'Error during grade create!'); 
          Session::flash('alert-class', 'alert-danger');
          return redirect()->route('grade.index');
      }
    }
    public function show($id, Request $request)
    {
        $grade = Grade::findOrFail($id);
        return view('admin.grade.show',compact('grade'));
       
    } 
    public function edit($id)
    {
        $grades = Grade::findOrFail($id);    
        return view('admin.grade.edit', compact('grades'));
    }

    public function update(Request $request,$id)
    {
    
      $validator = $request->validate([
      'grade_name' => 'required',
      'grade_min_percentage' => 'required',
      'grade_max_percentage' => 'required'
      ]);

      $grades = Grade::findOrFail($id);
      $grades->grade_name = $request->grade_name;
      $grades->grade_min_percentage = $request->grade_min_percentage;
      $grades->grade_max_percentage = $request->grade_max_percentage;
      $grades=$grades->save();
      if($grades)
      {
          Session::flash('message', 'Grade Updated successfully!'); 
          Session::flash('alert-class', 'alert-success');
          return redirect()->route('grade.index');
      }
      else
      {
          Session::flash('message', 'Error during grade update!'); 
          Session::flash('alert-class', 'alert-danger');
          return redirect()->route('grade.index');
      }  
    }
    public function destroy($id)
    {
      $grades = Grade::destroy($id); 
      if($grades)
      {
        Session::flash('message', 'Grade Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('grade.index');
      }
      else
      {
        Session::flash('message', 'Error during grade delete!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('grade.index');
      }     
    }

}
