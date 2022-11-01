<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\menuitem;

class Menuitemscontroller extends Controller
{
    public function index(){


        $menu = menuitem::all();

        return view('admin.menuitems.index',compact('menu'));
    }

    public function create(){


        return view('admin.menuitems.create');
    }

    public function store(Request $request){

      
        $menu = $request->all();

        $menu_create = menuitem::create($menu);
      
        return redirect()->route('admin.menuitems.index')
        ->with('success','Courses has been created successfully.');


    }

    public function edit($id){

        $menu = menuitem::findorfail($id);
        return view('admin.menuitems.edit',compact('menu'));

    }
    public function update(Request $request, $id){

        $menu = menuitem::findorfail($id);
        
        $menu->name = $request->name;
        $menu->status = $request->status;
        $menu->link = $request->link;

        $menu->save();

        return redirect()->route('admin.menuitems.index')->with('success','Menu Has Been updated successfully');

    }

    public function destroy($id){


       $menu_destroy =  menuitem::destroy($id);

        return redirect()->route('admin.menuitems.index')->with('success','Menu Has Been updated successfully');
    }
}
