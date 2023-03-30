<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use App\Models\unit;
use App\Models\payment;
use App\Models\sponsorrequested;
use App\Models\Performainvoice;
use App\Models\Additionalfee;
use App\Models\invoice;
use App\Models\Profile;
use App\Models\Courses;
use App\Models\Sponsor;
use App\Models\sem;
use App\Models\Courseselection;
use Session;
use PDF;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class Invoicecontroller extends Controller
{
    public function index(){

        $id= auth::id();
       

        try{
            $selectedcourse = Courses::select('courses.name','courses.id')
            ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
            ->where('courseselections.stu_id',$id)->pluck('courses.name')
            ->firstOrFail();
        }
        catch(\Exception $exception){
 
            return view('front.invoice.proformainvoiceerror');

        }
            $availableunits = DB::table('unit')->select('unit.id','unit.title','unit.units_price')
            ->get();
           // dd($availableunits);
            $selectedcoursefield = Courses::select('courses.name','courses.id')
            ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
            ->where('courseselections.stu_id',$id)->select('courses.programme')->get();
            $sem = sem::all();
            $additionalfee = Additionalfee::all();
            $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();
            $selectedid = explode(",", $unitselectionid);
            $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
            $statusis = $statuscheck[0]->status;

          //  dd($selectedcoursefield[0]->field);
          
       return view('front.invoice.proformainvoice',compact('selectedcourse','availableunits','selectedid','additionalfee','sem','statusis','selectedcoursefield'));

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
        //dd($unitsData);
        $courseData = $invoicedata[0]->sem;
     //   $courseData = json_decode($courseData);
        $unitsData = json_decode($unitsData); 
        $exist = $exist->additional_info;
        $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
        $statusis = $statuscheck[0]->status;
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
        return view('front.invoice.proformainvoicepreview',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','courseData','statusis'));
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
  
        //dd($request->units);
       $id = Auth::id();  
       $selectedcourse = DB::table('courses')
       ->select('courses.id')
       ->Join('courseselections','courseselections.StudentSelCid','=','courses.id')
       ->where('courseselections.stu_id',$id)
       ->get();
       $unitprice = DB::table('unit')
       ->select('units_price')->join('invoice', 'invoice.units', '=', 'unit.title' )
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
        $contxt = stream_context_create([ 
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed'=> TRUE
            ]
        ]);
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('front.invoice.invoice',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','courseData'));
        $path = public_path('pdf');
        $pdf->save($path.'/'.$name.'salesinvoice.pdf', $pdf->output());
        $dbstore = payment::updateOrCreate([

            'stu_id'=> auth::id(),

        ],[

            'invoice' => $name.'salesinvoice.pdf'
        ]);
        return $pdf->download($name.'salesinvoice.pdf');

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
        try{
            $exist = invoice::where('stu_id',$id)->firstOrFail(); 
        }      
        catch(\Exception $exception){
            return view('front.invoice.salesinvoiceerror');
        }
       
        $unitsData = $exist->units;
        $courseData = $invoicedata[0]->sem;
     //   $courseData = json_decode($courseData);
        $unitsData = json_decode($unitsData); 
        $exist = $exist->additional_info;
        $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
        $statusis = $statuscheck[0]->status;
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
        return view('front.invoice.proformasalesinvoice',compact('student_course_offer','user','exist','location','communication','invoicedata','selectedcourse','unitsData','courseData','statusis'));

    }


    public function payment(){

 
        $id = Auth::id();
        try{
            
            $invoicedata = invoice::select('*')->where('stu_id',$id)->firstOrFail();
            
        }
        catch(\Exception $exception){
            return view('front.invoice.confirmpaymenterror');
        }
        $total = payment::select('*')->where('stu_id',$id)->get();
        $date = invoice::select('updated_at')->where('stu_id',$id)->get();
        $date = $date->add(4);
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();      
        $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
        $statusis = $statuscheck[0]->status;


        return view ('front.invoice.confirmpayment',compact('invoicedata','total','date','student_course_offer','statusis'));

    }

    public function refund(Request $request){

        $id= Auth::id();
        $dueDate = Carbon::now()->addDays(4);
        $refundpolicy = payment::updateorcreate([


            'stu_id' =>$id,


        ],
        [


            'stu_id' => auth::id(),
            'refundpolicy' =>implode(',',$request->refund),
            'duedate' => $dueDate,
            'refundtime' =>  Carbon::now()->toDateTimeString()

        ]);

   //     dd($request->payment);

        if($request->payment == '5'){
            return redirect()->route('sponsorlist');
        }

        else{

            return redirect()->route('confirmpayment');
        }
        

       

    }
    public function total(Request $request){

        
        $id= Auth::id();
        $invoicenoid = invoice::select('invoiceno')->where('stu_id',auth::id())->first();
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

        $reminderdate = User::updateOrCreate([

            'id' =>$id

        ],[


            'reminderdate'  => now()->addDays(5),
            'paymentduedate' => now()->addDays(10)
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
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
     
     
       // dd($date);

        return view('front.invoice.recieptsubmit',compact('invoicedata','total','amountdue','amountpaid','student_course_offer'));
    }

    public function success(){
        $id = auth::id();
        $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
        $statusis = $statuscheck[0]->status;

        return view('front.invoice.submitsuccess',compact('statusis'));
    }
    public function reciept(Request $request){


        $id= Auth::id();
        $amountdue = payment::select('balance_due')->where('stu_id',$id)->get();
        $amountpaid =  payment::select('amount_paid')->where('stu_id',$id)->get();
    //    $balancedue = $amountdue[0]->amountdue - $amountpaid[0]->amount_paid;

    if ($request->hasFile('payreciept')) {
        $fileName = $request->payreciept->getClientOriginalName();
        $request->payreciept->move(public_path('payreciept'), $fileName);
    }
        $reciept = payment::updateorcreate([


            'stu_id' =>$id,


        ],
        
        [


            'stu_id' => auth::id(),
            'amount_paid' =>$request->amount_paid + $amountpaid[0]->amount_paid,
            "payreciept" =>$request->file('payreciept')->getClientOriginalName(),
            'balance_due' =>   $amountdue[0]->balance_due - $request->amount_paid,
            'status'   => 'waiting Reconcillation',



        ]);
        


        return redirect()->route('submitsuccess');

    }

    public function history(){

       
        $id=auth::id();
        try{
            $total = payment::select('*')->where('stu_id',$id)->firstOrFail();
        }
        catch(\Exception $exception){

            return view('front.invoice.historyerror');
        }
     
        $amountdue = payment::select('amountdue','status')->where('stu_id',$id)->get();
        $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
        $statusis = $statuscheck[0]->status;



        return view('front.invoice.history',compact('amountdue','total','statusis'));
    }

public function sponsorlist(){

    $sponsordata = Sponsor::all();
    return view('front.invoice.sponsorlist',compact('sponsordata'));
}

public function sponsorrequest(Request $request){

    $userid = $request->userid;
    $sponsorid = $request->sponsor_id;
    $studid = DB::table('sponsors')->select('stu_id')->where('id',$request->sponsor_id)->get();
    $stuid = $studid[0]->stu_id;
    $st = $stuid;
    if($st == null ){
        $st = array(0,$userid);
        $stdin = array_filter($st);
        $studentid = implode($stdin);
    }
    else{

      

      $stdd = array($st,$userid);
      $studentid = implode(',',$stdd);
    

   }


   // dd($studentid);
   //dd($sponsorid);
    $sponsorrequest = Sponsor::updateorcreate([

        'id' => $request->sponsor_id,
    ]
,[

           'stu_id' => $studentid
]

);
$sponsorrequested = sponsorrequested::create([

    'stu_id' => $userid,
    'sponsor_id' =>$request->sponsor_id
]

);

return redirect()->route('sponsorlist');

}


public function refundrequest(){

    $id = auth::id();

    $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
    $statusis = $statuscheck[0]->status;


    return view('front.invoice.refundrequest',compact('statusis'));



}


public function refundrequestpost(Request $request){


    $id = auth::id();

   

    $refundpost = payment::updateOrCreate([


        'stu_id' => $id


    ],[


        'refundrequest'  => 'yes',
        'refundreason' => $request->refundreason


    ]);



    return redirect()->back()->with('success','Refund has been requested!!');

}

    
}
