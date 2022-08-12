<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Role;
use Hash;
class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
     $data['users'] = User::all();
     $data1['role']= Role::all();
    return view('admin\user.index', $data,$data1);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $urole = Role::all();
        //return view('categories.create', compact('categories'));
        return view('admin\user.create',compact('urole'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'user_role' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->uid = $request->uid;
        $user->user_role = '3';
        $user->email = $request->email;
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
    public function show(User $user)
    {
    $role = Role::all();         
    return view('admin/user.show',compact('user','role'));
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
        return view('admin/user.edit', compact('user','role'));
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
            'uid' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

    $user = User::findOrFail($id);
    $user->uid =$request->uid;
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
