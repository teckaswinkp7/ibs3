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
use DB;

class DocumentVerificationController extends Controller
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




     $users = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->get();

     $institute = DB::table('institute')->select('title','type','description')->get();
     //$educat = Document::all();
    return view('admin.application.index',compact('users','institute'));
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
     $cgpa = Session::get('cgpa');
     return view('admin.application.verify',compact('user','student_edu'),compact('cgpa'));
    }


    public function obtain(Request $request){

        $id = auth::id();

        $grades = $request->grade;

        $gradelength = count($grades);
        $a=$grades;
       
       $newarray = (array_map(function($v){
        if ($v==="A")
        {
        return "5";
        }
      elseif($v === "B"){

        return "4";
      }
      elseif($v === "C"){
        return "3";
      }
      elseif($v === "D"){

        return "2";
      }
      elseif($v === "E"){

        return "1";
      }
      elseif($v === "F"){
        return "0";
      }
      return $v;

       },$a));

 $cgpa = array_sum($newarray)/$gradelength;
      
    return redirect()->back()->with(compact('cgpa'));






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
        return redirect()->route('application.index')
        ->with('success','created successfully.');
    }



    public function search(Request $request){


      $fromdate = $request->fromdate;
      $todate = $request->todate;

      $users = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->whereBetween('education.updated_at',[$fromdate,$todate])
     ->get();
     //$educat = Document::all();
    return view('admin.application.index',compact('users'));



    }

    
    public function searchname(Request $request){

      $search = $request->searchname;

      $users = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->where('users.name','LIKE','%'.$search.'%')
     ->get();
     //$educat = Document::all();
    return view('admin.application.index',compact('users'));



    }


    public function userexport(){




      return Excel::download(new UsersExport, 'users.xlsx');


    }





}
