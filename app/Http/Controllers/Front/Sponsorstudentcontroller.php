<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use App\Models\sponsoredstudents;
use App\Models\Sponsor;
use App\Models\paymentsession;
use App\Models\payment;

class Sponsorstudentcontroller extends Controller
{

    public function index(Request $request){


     $sponsorstudentdata = DB::table('sponsors')
     ->join('users','users.id','=','sponsors.stu_id')
     ->select('sponsors.stu_id','users.name','users.id')
     ->where('sponsors.id',auth::id())->get();

      $studid = $sponsorstudentdata[0]->stu_id;
      $std = explode(',',$studid);
      

      $search = $request->search ?? "";
        foreach ($std as $key => $val) {
           
           
            $st = explode(',',$val);
           // print_r($st);
            
            $student = DB::table('users')
            ->join('payment','users.id','=','payment.stu_id')
            ->join('invoice','users.id','=','invoice.stu_id')
            ->join('courses','invoice.course_id','=','courses.id')
            ->select('users.id','users.name','users.email','payment.amountdue','payment.balance_due','payment.ibs_reciept','invoice.course_id','invoice.invoiceno','invoice.updated_at','courses.name as course_name')
            ->where('users.id',$st)
           ->get()->toArray();
            
             }
    
        
      

     // dd($search);
    
    
   //  dd($stdata);
     
        return view('front.sponsor.sponsorstudentview',compact('sponsorstudentdata','std','search','student'));
    }


    public function sponsoredstudent(Request $request){


        $sponsoredstudent = sponsoredstudents::updateOrCreate([

            'stu_id' => $request->stu_id
        ],[

            
            'stu_id'=> $request->stu_id,
            'sponsor_id' => auth::id(),
            'request_accepted' => $request->request_accepted,

        ]);

        $sponsoraccepted = payment::updateOrCreate([


            'stu_id' => $request->stu_id
        ],[


            'sponsor_accepted' =>$request->request_accepted
        ]);
        
        
        
        

        return redirect()->route('sponsorstudentview');


    }

    public function sponsoredstudentview(Request $request){

        $sponsoredstudentdata = sponsoredstudents::all();

    

        return view('front.sponsor.sponsoredstudents',compact('sponsoredstudentdata'));
    }
    public function confirmpaymentpost(Request $request){


        $value = Sponsor::updateOrCreate([

            'id' =>auth::id()

        ],[


            'selected_stu_id' => Session::put('selected',json_encode($request->sponsored))
        ]);
         
        

       
        return redirect()->route('confirmsponsorpayment');
    }

    public function confirmsponsorpayment(Request $request){

     

        $selected = Session::get('selected');
        
      $stu_id = json_decode($selected);

     foreach($stu_id as $key => $select){
 
     
        $valid = explode(',',$select);

        $val = $valid[1];

 $student = DB::table('users')->where('users.id',$val)
->join('sponsoredstudents','sponsoredstudents.stu_id','=','users.id')
->join('payment','users.id','=','payment.stu_id')
->join('invoice','users.id','=','invoice.stu_id')
->join('courses','invoice.course_id','=','courses.id')
->select('users.id','users.name','users.email','courses.name as course_name','invoice.updated_at','payment.amountdue','sponsoredstudents.stu_id','invoice.invoiceno')
->where('request_accepted','yes')->get();
     



}
       
       
        return view('front.sponsor.confirmsponsorpayment',compact('selected','stu_id'));

    }

    public function payrecieptpost(Request $request){

       
        if ($request->hasFile('payreciept')) {
            $fileName = $request->payreciept->getClientOriginalName();
            $request->payreciept->move(public_path('payreciept'), $fileName);
        }

        $recieptpost = paymentsession::Create([


            'sponsor_id' => auth::id(),
            'paid_stu_id' => json_encode($request->stu_id),
            'paid_reciept' => $request->payreciept,
            
        ]);

        $stu_id = $request->stu_id;
       
       foreach($stu_id as $stid){

        $amountdue = payment::select('balance_due')->where('stu_id',$stid)->get();
        $amountpaid =  payment::select('amount_paid')->where('stu_id',$stid)->get();

        $paymentupdate = payment::updateOrCreate(
            [

              'stu_id' => $stid

            ],[

                'amount_paid' =>$request->amount_paid + $amountpaid[0]->amount_paid,
                'balance_due' =>   $amountdue[0]->balance_due - $request->amount_paid,
                'status'   => 'waiting Reconcillation',

        ]);

       }
       
       
       
      //  dd($paymentupdate);


 
      return redirect()->route('sponsorrecieptsubmitsuccess');

       
    }


    public function recieptsuccess(){


        return view('front.sponsor.sponsorrecieptsubmitsuccess');
    }


    public function history(){

        $id = auth::id();
        $paidstudents = DB::table('paymentsession')->select('*')->where('sponsor_id',$id)->get();



        return view('front.sponsor.history',compact('paidstudents'));
    }
}
