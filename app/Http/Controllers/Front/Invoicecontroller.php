<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use App\Models\Courseselection;
use Session;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Invoicecontroller extends Controller
{
    public function index(){


        $id= auth::id();

        $selectedcourse = DB::table('courses')
        ->select('courses.name','courses.id')
        ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
        ->where('courseselections.stu_id',$id)
        ->get();

        $availableunits = DB::table('units')->select('units.id','units.title','units.slug','units.short_text','units.unit_price','units.course_id')->
        join('courseselections','courseselections.StudentSelCid','=','units.course_id')->
        where('courseselections.stu_id','=',$id)->
        get();

        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();

        $selectedid = explode(",", $unitselectionid);


        return view('front.invoice.proformainvoice',compact('selectedcourse','availableunits','selectedid'));

    }


    public function preview(){


        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $email = $user->email;
        $name = $user->name;
        
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();

        return view('front.invoice.proformainvoicepreview',compact('student_course_offer','user'));
    }

    public function store(Request $request){

 

        return redirect()->route('proformainvoicepreview');


    }


}
