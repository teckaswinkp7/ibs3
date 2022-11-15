<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\unit;
use Illuminate\Support\Str;
use DB;

class Unitcontroller extends Controller
{
    public function index() {

      // $units = DB::table('units')
     //  ->select('units.id','units.course_id','units.title','units.slug','units.position','units.free_lesson','units.published')->leftjoin('courses','courses.id','=','units.course_id')
       
     //  ->get();

       $units= DB::table('units')
       ->join('courses','units.course_id','=','courses.id')
       ->select('units.*','courses.name as courses_name')
       ->get();
                                         
   
     return view('admin.units.index',compact('units'));

    }

    public function create(){

          $courses = Courses::select('courses.id','courses.name')->get();


        return view('admin.units.create',compact('courses'));
    }

    public function store(Request $request){
    
        unit::create(
            [
               'course_id'   => $request->course_id,
               'title'       => $request->title,
               'slug'        => str::slug($request->slug),
               'embed_id'    => $request->embed_id,
               'short_text'  => $request->short_text,
               'unit_price' =>  $request->unit_price,
               'full_text'   => $request->full_text,
               'published'   => $request->published,
               'name'        => $request->name
]
            
            + ['position' => unit::where('course_id', $request->course_id)->max('position') + 1]
        );

        return redirect()->route('admin.units.index',  ['course_id' => $request->course_id]);
    }

    public function edit($id){


        
        
        $units = unit::findorfail($id);
        $courses = Courses::select('courses.id','courses.name')->get();

        return view('admin.units.edit',compact('units','courses'));

    }

    public function update(Request $request,$id){

        $units = unit::findorfail($id);
        
    
            $units->course_id   = $request->course_id;
               $units->title       = $request->title;
               $units->slug        = str::slug($request->slug);
               $units->embed_id    = $request->embed_id;
               $units->short_text  = $request->short_text;
               $units->full_text   = $request->full_text;
               $units->unit_price = $request->unit_price;
               $units->published   = $request->published;
               $units->position    = unit::where('course_id', $request->course_id)->max('position') + 1;

               $units->Save();


        return redirect()->route('admin.units.index');
    }

    public function destroy($id){

         $unit_destroy = unit::destroy($id);

         return redirect()->route('admin.units.index');

    }
}
