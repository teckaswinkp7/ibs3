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
    $users = User::where('user_role',2)->where('status',3)->get();
    //$users = User::select('users.*','courseselections.offer_generated')->join("courseselections","courseselections.stu_id","=","users.id")->where("courseselections.offer_generated","=",0)->where('users.user_role',2)->get();
    $educat = Document::where('status',1)->get();          
    return view('admin.screening.index',compact('users','educat'));
    }

    public function course($id)
    {
        $user = User::findOrFail($id);  
        $course = Courses::all();       
        return view('admin.screening.course',compact('user','course'));
    }
    public function store(Request $request)
    {

        $docum = new Courseselection;
        $course = $request->all();
        $id=$request->stu_id;
        $studentcourseselect=Courseselection::create([
            'stu_id'            => $request->stu_id,
            'course_id'         => json_encode($request->course_id),
            //'offer_generated'   =>1,
        ]);
        $status = User::where('id', $id)->update(array('status' => 4));
        return redirect()->route('screening.index')
        ->with('success','created successfully.');
    }
}
