<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use App\Models\unit;
use App\Models\payment;
use App\Models\Performainvoice;
use App\Models\Additionalfee;
use App\Models\invoice;
use App\Models\Profile;
use App\Models\sem;
use App\Models\Courseselection;
use Session;
use PDF;





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

        $sem = sem::all();
        $additionalfee = Additionalfee::all();
        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
        $selectedid = explode(",", $unitselectionid);
        return view('front.invoice.proformainvoice',compact('selectedcourse','availableunits','selectedid','additionalfee','sem'));

    }


    public function preview(){
        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $email = $user->email;
        $name = $user->name;
        $selectedcourse = DB::table('courses')
        ->select('courses.name','courses.id','courses.price')
        ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
        ->where('courseselections.stu_id',$id)
        ->get();        
        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
        $selectedid = explode(",", $unitselectionid);   
        $invoicedata = invoice::where('stu_id',$id)->select('invoiceno','sem','allunits')->get();         
        $exist = invoice::where('stu_id',$id)->first();  
        $unitsData = $exist->units;
        $courseData = $invoicedata[0]->sem;
     //   $courseData = json_decode($courseData);
        $unitsData = json_decode($unitsData); 
        $exist = $exist->additional_info;
   //     $unitPrice = array();
        //$unitsData['price'] = array();
  //      foreach($unitsData as $val)
 //       {
  //          $data = DB::table('units')->select('unit_price')->where('title',$val)->first();
  //          array_push($unitPrice,$data->unit_price);
  //      }
     //   dd($unitPrice);
        $exist = json_decode($exist);
        $location = Profile::where('stu_id',$id)->select('current_location','current_address_location')->first();
        $communication = User::where('id',$id)->select('email','phone')->first();        
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
        return view('front.invoice.proformainvoicepreview',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','courseData'));
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
       $selectedcourse = DB::table('courses')
       ->select('courses.id')
       ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
       ->where('courseselections.stu_id',$id)
       ->get();
       $unitprice = DB::table('units')
       ->select('unit_price')->join('invoice', 'invoice.units', '=', 'units.title' )
       ->where('stu_id',$id)
       ->get();
       
       
       $invoice = invoice::updateOrCreate([

        'stu_id' => $id,

       ],[

        'stu_id' => auth::id(),
        'stud_type' =>  $request->stud_type,
        'course_id' => $selectedcourse[0]->id,
        'sem' => $request->sem,
        'units' => json_encode($request->units),
        'allunits' =>json_encode($request->allunits),
        'additional_info' =>json_encode($request->additional_info),
        'invoiceno' => '#INV'.rand(0000,9999)
    ]);


      
     return redirect()->route('proformainvoicepreview');
    
    }
    public function viewpdf(){

        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $email = $user->email;
        $name = $user->name;
        $selectedcourse = DB::table('courses')
        ->select('courses.name','courses.id','courses.price')
        ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
        ->where('courseselections.stu_id',$id)
        ->get();        
        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
        $selectedid = explode(",", $unitselectionid);   
        $invoicedata = invoice::where('stu_id',$id)->select('invoiceno','sem','allunits')->get();         
        $exist = invoice::where('stu_id',$id)->first();  
        $unitsData = $exist->units;
        $courseData = $invoicedata[0]->sem;
     //   $courseData = json_decode($courseData);
        $unitsData = json_decode($unitsData); 
        $exist = $exist->additional_info;
   //     $unitPrice = array();
        //$unitsData['price'] = array();
  //      foreach($unitsData as $val)
 //       {
  //          $data = DB::table('units')->select('unit_price')->where('title',$val)->first();
  //          array_push($unitPrice,$data->unit_price);
  //      }
     //   dd($unitPrice);
        $exist = json_decode($exist);
        $location = Profile::where('stu_id',$id)->select('current_location','current_address_location')->first();
        $communication = User::where('id',$id)->select('email','phone')->first();        
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();

        $pdf = \PDF::loadView('front.invoice.invoice',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','courseData'));
        return $pdf->download('invoice.pdf');

   //     PDF::Output(uniqid().'_SamplePDF.pdf', 'D');
        
       // $pdf = PDF::loadview('front.invoice.invoice',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','unitPrice'));
     //   return $pdf->download('invoice.pdf');


    }

    public function salesinvoice(){

        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $email = $user->email;
        $name = $user->name;
        $selectedcourse = DB::table('courses')
        ->select('courses.name','courses.id','courses.price')
        ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
        ->where('courseselections.stu_id',$id)
        ->get();        
        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
        $selectedid = explode(",", $unitselectionid);   
        $invoicedata = invoice::where('stu_id',$id)->select('invoiceno','sem','allunits')->get();         
        $exist = invoice::where('stu_id',$id)->first();  
        $unitsData = $exist->units;
        $courseData = $invoicedata[0]->sem;
     //   $courseData = json_decode($courseData);
        $unitsData = json_decode($unitsData); 
        $exist = $exist->additional_info;
   //     $unitPrice = array();
        //$unitsData['price'] = array();
  //      foreach($unitsData as $val)
 //       {
  //          $data = DB::table('units')->select('unit_price')->where('title',$val)->first();
  //          array_push($unitPrice,$data->unit_price);
  //      }
     //   dd($unitPrice);
        $exist = json_decode($exist);
        $location = Profile::where('stu_id',$id)->select('current_location','current_address_location')->first();
        $communication = User::where('id',$id)->select('email','phone')->first();        
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
        return view('front.invoice.proformasalesinvoice',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','courseData'));

    }


    public function payment(){

 
        $id = Auth::id();
        $invoicedata = invoice::select('*')->where('stu_id',$id)->get();
        $total = payment::select('*')->where('stu_id',$id)->get();
        $date = invoice::select('updated_at')->where('stu_id',$id)->get();
        $date = $date->add(4);
       


        return view ('front.invoice.confirmpayment',compact('invoicedata','total','date'));

    }

    public function refund(Request $request){

        $id= Auth::id();
        $refundpolicy = payment::updateorcreate([


            'stu_id' =>$id,


        ],
        [


            'stu_id' => auth::id(),
            'refundpolicy' =>implode(',',$request->refund),



        ]);


        return redirect()->route('confirmpayment');

    }
    public function total(Request $request){

        
        $id= Auth::id();
        $amountdue = payment::updateorcreate([


            'stu_id' =>$id,


        ],
        [


            'stu_id' => auth::id(),
            'amountdue' =>$request->amountdue,
            'balance_due' =>$request->amountdue,
            'amount_paid' => '0',
            'status'   => 'waiting payment',



        ]);


        return redirect()->route('proformasalesinvoice');

    }

    public function recieptsubmit(){

        $id = Auth::id();
        $amountdue = payment::select('amountdue')->where('stu_id',$id)->get();
        $amountpaid =  payment::select('amount_paid')->where('stu_id',$id)->get();
        $invoicedata = invoice::select('*')->where('stu_id',$id)->get();
        $total = payment::select('*')->where('stu_id',$id)->get();
        $date = invoice::select('updated_at')->where('stu_id',$id)->get();
        $date = $date->add(4);


        return view('front.invoice.recieptsubmit',compact('invoicedata','total','amountdue','amountpaid'));
    }

    public function success(){


        return view('front.invoice.submitsuccess');
    }
    public function reciept(Request $request){


        $id= Auth::id();
        $amountdue = payment::select('amountdue')->where('stu_id',$id)->get();
     //   $amountpaid =  payment::select('amount_paid')->where('stu_id',$id)->get();
    //    $balancedue = $amountdue[0]->amountdue - $amountpaid[0]->amount_paid;
        $reciept = payment::updateorcreate([


            'stu_id' =>$id,


        ],
        
        [


            'stu_id' => auth::id(),
            'amount_paid' =>$request->amount_paid,
            'payreciept' =>$request->file('payreciept')->getclientoriginalname(),
            'balance_due' =>   $amountdue[0]->amountdue - $request->amount_paid,
      
            'status'   => 'waiting Reconcillation',



        ]);
        


        return redirect()->route('submitsuccess');

    }

}
