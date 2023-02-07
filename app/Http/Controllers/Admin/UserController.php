<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Education;
use App\Models\Courses;
use App\Models\Role;
use Hash;
class UserController extends Controller
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
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
     $data['users'] = User::all();
     $data1['role']= Role::all();
    return view('admin.user.index', $data,$data1);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $urole = Role::all();
        $courses = Courses::all();
        //return view('categories.create', compact('categories'));
        return view('admin.user.create',compact('urole','courses'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            //'uid' => 'required|unique:users',
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'user_role' => 'required',
            'password' => 'required|min:6',
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->user_role = $request->user_role;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->user_role == 3)
        {
            $user->is_email_verified = 1;
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.index')
        ->with('success','Role has been created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show($id, Request $request)
    {
    //$role = Role::all();
    
    $user = User::findOrFail($id);
    $student_edu = Education::where('stu_id',$id)->get();          
    return view('admin.user.show',compact('user','student_edu'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = User::findOrFail($id);   
        $role = Role::all();      
        return view('admin.user.edit', compact('user','role'));
    }

    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id)
    {    
        $validator = $request->validate([
         //   'uid' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

    $user = User::findOrFail($id);
 //   $user->uid =$request->uid;
    $user->user_role = $request->user_role;
    $user->email =$request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    return redirect()->route('user.index')
    ->with('success','User Has Been updated successfully');   

    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    $users = User::destroy($id);    
    return redirect()->route('user.index')
    ->with('success','user has been deleted successfully');
    }

}
