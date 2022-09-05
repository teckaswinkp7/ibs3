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
     $users = User::where('user_role',2)->where('status',2)->get();
     //$educat = Document::all();
    return view('admin\enrollment.index',compact('users'));
    }
    public function verify($id)
    {
     //$data['categories'] = Category::orderBy('id','desc')->paginate(5)
     //$data['users'] = User::all();
     //$data1['role']= Role::all();
     //$data['users'] = User::where('user_role',2) ->get();
     $user = User::findOrFail($id);  
     $student_edu =  Education::where('stu_id',$id)->get();     
     return view('admin\enrollment.verify',compact('user','student_edu'));
    }
    public function store(Request $request)
    {

        $docum = new Document;
        $id=$request->stu_id;
        $docum->stu_id =$request->stu_id;
        $docum->status = $request->status;
        $docum->save();
        $status = User::where('id', $id)->update(array('status' => 3));
        return redirect()->route('enrollment.index')
        ->with('success','created successfully.');
    }
}
