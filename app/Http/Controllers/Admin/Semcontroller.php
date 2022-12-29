<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\sem;


class Semcontroller extends Controller
{

public function index(){

    $semfee = sem::all();

      return view('admin.sem.index',compact('semfee'));    
}

public function create(){
    

    return view('admin.sem.create');
}

public function store(Request $request){


    $validation = $this->validate($request,[

        'name' => 'string|required',
        'course_id' => 'required',
        'info'  => 'string|required',
        'price' => 'required'

    ]);

    $sem = sem::create([
   

        'name'=> $request->name,

        'course_id' => $request->course_id,

        'info'      => $request->info,

        'price'     => $request->price



    ]);

    if($sem){

        request()->session()->flash('success','Sem Added Successfully !');
    }
    else{

        request()->session()->flash('error','Error Adding Sem!');

    }
    return redirect()->route('admin.sem.index');

}
public function edit($id){

     
    $sem = sem::findorfail($id);
    
    return view('admin.sem.edit',compact('sem'));

}

public function update(Request $request,$id){


    $sem = sem::findorfail($id);
    

    $sem->name   = $request->name;
    $sem->info =$request->info;
    $sem->price  = $request->price;
    $sem->course_id = $request->course_id;
    
      

       $sem->Save();

   


 return redirect()->route('admin.sem.index')->with('Success','Sem Fee Updated');


}


public function delete($id){

   $sem_destroy = sem::destroy($id);

   return redirect()->route('admin.sem.index');

}

}
