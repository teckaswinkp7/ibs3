<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Additionalfee;
use Illuminate\Support\Facades\Auth;

class Additionalfeecontroller extends Controller
{
    public function index(){

        $additionalfee = Additionalfee::all();

        return view('admin.additionalfee.index',compact('additionalfee'));

    }

    public function create(){


        return view('admin.additionalfee.create');

    }
    
    public function store(Request $request){

        $request->validate([
            'title' => 'required',
            'description'      => 'string|required',
            'price'=>'required',
            'status' => 'required',
            ]);

     $createadditionalfee = Additionalfee::create([

           
            'title' => $request->title,
            'description'  => $request->description,
            'price' =>$request->price,
            'status' => $request->status,

     ]);


     if($createadditionalfee){

        request()->session()->flash('success','Additionalfee Created Successfully!');
     }
     else{


        request()->session()->flash('error','Something went wrong!');
     }


     return redirect()->route('admin.additionalfee.index')->with('Success','Additional Fee Added');



    }
   
    public function edit($id){

     
        $additional = Additionalfee::findorfail($id);
        
        return view('admin.additionalfee.edit',compact('additional'));

    }

    public function update(Request $request,$id){


        $additionalfee = Additionalfee::findorfail($id);
        
    
        $additionalfee->title   = $request->title;
        $additionalfee->description =$request->description;
        $additionalfee->price  = $request->price;
        $additionalfee->status = $request->status;
        
          

           $additionalfee->Save();

       


     return redirect()->route('admin.additionalfee.index')->with('Success','Additional Fee Updated');


    }


    public function delete($id){

       $additionalfee_destroy = Additionalfee::destroy($id);

       return redirect()->route('admin.additionalfee.index');

    }
}
