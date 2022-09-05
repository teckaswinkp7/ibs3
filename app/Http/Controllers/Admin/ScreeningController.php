<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Courses;
use App\Models\Courseselection;
use App\Models\Document;
use Hash;
class ScreeningController extends Controller
{
    //
    public function index()
    {
    $id = Auth::user()->id; 
    $users = User::where('user_role',2) ->get();
    $educat = Document::all();
    $courseselect = Courseselection::where('stu_id', $id);          
    return view('admin\screening.index',compact('users','educat','courseselect'));
    }

    public function course($id)
    {

        $user = User::findOrFail($id);  
        $course = Courses::all();       
        return view('admin\screening.course',compact('user','course'));
    }
    public function store(Request $request)
    {

        $docum = new Courseselection;
        $course = $request->all();
        $studentcourseselect=Courseselection::create([
            'stu_id'         => $request->stu_id,
            'course_id'    => json_encode($request->course_id),
        ]);
        return redirect()->route('screening.index')
        ->with('success','created successfully.');
    }
}
