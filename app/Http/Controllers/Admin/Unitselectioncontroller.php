<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\unitselection;
use App\Models\Courseselection;
use DB;

class Unitselectioncontroller extends Controller
{

    public function index(){

return view ('front.education.course-offer');
    }

    public function store(Request $request){

        

        $request->validate([
            'units_id' => 'required',
     ]);
      
         $id = auth::id();
         
         $course_idname = DB::table('courseselections')->select('courseselections.studentSelCid')->
         where('courseselections.stu_id',$id)->get();
        $unitselection = unitselection::updateOrCreate([
          
            'stu_id' => $id,

        ],[

        'stu_id'     => auth::id(),
        'course_id'  => $request->course_id,
        'units_id'       => implode(',',$request->units_id),
        'selected_units' => $request->selected_units,
        'checked'        => $request->has('checked')

     ]);     

     
     return redirect()->back()->with('success','Submitted');

    }
}
