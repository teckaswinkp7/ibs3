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
    //
    public function index()
    {
      //$data['categories'] = Category::orderBy('id','desc')->paginate(5)
     // $data['users'] = User::all();
     //$data1['role']= Role::all();
     $data['users'] = User::where('user_role',2) ->get();
     $data1['educat'] = Document::all();
    return view('admin\enrollment.index',$data,$data1);
    }
    public function verify($id)
    {
     //$data['categories'] = Category::orderBy('id','desc')->paginate(5)
     //$data['users'] = User::all();
     //$data1['role']= Role::all();
     //$data['users'] = User::where('user_role',2) ->get();
     $user = User::findOrFail($id);  
     $student_edu = Education::all();     
     return view('admin\enrollment.verify',compact('user','student_edu'));
    }
    public function store(Request $request)
    {

        $docum = new Document;
        $docum->stu_id =$request->stu_id;
        $docum->status = $request->status;
        $docum->save();
        return redirect()->route('enrollment.index')
        ->with('success','created successfully.');
    }
}
