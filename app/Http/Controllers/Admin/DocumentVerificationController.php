<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Courses;
use App\Models\Role;
use App\Models\Education;
use App\Models\Document;
use Hash;
class DocumentVerificationController extends Controller
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
     $users = User::where('user_role',2)->where('status',2)->get();
     //$educat = Document::all();
    return view('admin.enrollment.index',compact('users'));
    }
    public function verify($id)
    {
     //$data['categories'] = Category::orderBy('id','desc')->paginate(5)
     //$data['users'] = User::all();
     //$data1['role']= Role::all();
     //$data['users'] = User::where('user_role',2) ->get();
     $user = User::findOrFail($id);  
     //$student_edu =  Education::join('documents','documents.edu_id','education.id')->where('education.stu_id',$id)->where('documents.status',1)->get();   
     $student_edu =  Education::where('stu_id',$id)->where('verification_status',null)->get();
     //dd($student_edu);  
     return view('admin.enrollment.verify',compact('user','student_edu'));
    }
    public function store(Request $request)
    {
        $docum = new Document;
        $id=$request->stu_id;
        $student_edu =  Education::where('stu_id',$id)->get();
        foreach($student_edu as $val)
        {
            $vals = array('stu_id'=>$val->stu_id,'edu_id'=>$val->id,'status'=>$request->status);            
            $docum->create($vals);
            Education::where('id', $val->id)->update(array('verification_status' => $request->status));            
        }
        // $docum->stu_id =$request->stu_id;
        // $docum->status = $request->status;
        // $docum->edu_id = $request->edu_id;
        // $docum->save();
        $status = User::where('id', $id)->update(array('status' => 3));
        return redirect()->route('enrollment.index')
        ->with('success','created successfully.');
    }
}
