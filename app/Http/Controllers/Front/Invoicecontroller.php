<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use App\Models\unit;
use App\Models\Performainvoice;
use App\Models\Profile;
use App\Models\Courseselection;
use Session;
use Barryvdh\DomPDF\Facade\Pdf;




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
        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
        $selectedid = explode(",", $unitselectionid);   
        $invoicedata = performainvoice::where('stu_id',$id)->select('invoiceno','payment_period')->get();         
        $exist = Performainvoice::where('stu_id',$id)->first();  
        $unitsData = $exist->units;
        $exist = $exist->additional_item;
        $exist = json_decode($exist);
        $location = Profile::where('stu_id',$id)->select('current_location','current_address_location')->first();
        $communication = User::where('id',$id)->select('email','phone')->first();        
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
        return view('front.invoice.proformainvoicepreview',compact('student_course_offer','user','exist','location','communication','unitsData','invoicedata'));
    }

    public function store(Request $request){
       
        /*
        $id = Auth::id();  
       $data = $request->except('_token');      
    //   $additional = json_encode($val);  
        $invoiceno = '#INV-'.time();      
        $val = array('stu_id'=>$id,
        'additional_item'=>$data['additional_item'],
        'study_type'=>$data['study_type'],
        'payment_period'=>$data['payment_period'],
       'units'=> $data['units'], 
        'invoiceno' => $invoiceno,
    
    );
        $exist = Performainvoice::where('stu_id',$id)->get();
        $exist_count = count($exist);
        if($exist_count <=0)
        {
            $inserted = Performainvoice::create($val);                       
        }
        else
        {
           $updated = Performainvoice::where('stu_id',$id)->update($val);    

        }


        */
  
       $id = Auth::id();  
       $randomNumber = random_int(100000, 999999);
       $unitprice = DB::table('units')
       ->select('units.unit_price')->join('performainvoices', 'performainvoices.units', '=', 'units.id' )
       ->where('stu_id',$id)
       ->get();
       
       
       $invoice = performainvoice::updateOrCreate([

        'stu_id' => $id,

       ],[

        'stu_id' => auth::id(),
        'study_type' =>  $request->study_type,
        'payment_period' => $request->payment_period,
        'units' => json_encode($request->units),
        'additional_item' =>json_encode($request->additional_item),
        'invoiceno' => '#INV-'.$randomNumber,
    ]);



      
     return redirect()->route('proformainvoicepreview');
    
    }
    public function viewpdf(){

        $id= auth::id();
        $selectedcourse = DB::table('courses')
        ->select('courses.name','courses.id')
        ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
        ->where('courseselections.stu_id',$id)
        ->get();
        $invoiceid = performainvoice::where('stu_id',$id)->select('invoiceno')->get();  
        $availableunits = DB::table('units')->select('units.id','units.title','units.slug','units.short_text','units.unit_price','units.course_id')->
        join('courseselections','courseselections.StudentSelCid','=','units.course_id')->
        where('courseselections.stu_id','=',$id)->
        get();
        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
        $selectedid = explode(",", $unitselectionid);
        $location = Profile::where('stu_id',$id)->select('current_location','current_address_location')->first();
        $communication = User::where('id',$id)->select('email','phone')->first();        
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
        $invoicedata = performainvoice::where('stu_id',$id)->select('invoiceno','payment_period')->get();  
        $user = User::where('id',$id)->first();
        $exist = Performainvoice::where('stu_id',$id)->first();
        $exist = $exist->additional_item;
        $exist = json_decode($exist);  

        $pdf = PDF::loadview('front.invoice.invoice',compact('invoiceid','location','user','exist','invoicedata'));
        return $pdf->download('invoice.pdf');


    }
}
