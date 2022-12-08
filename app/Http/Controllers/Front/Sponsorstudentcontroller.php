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
use App\Models\Courses;
use App\Models\paymentsession;
use App\Models\payment;

class Sponsorstudentcontroller extends Controller
{

    public function index(Request $request){
        
      // dd(Carbon::parse($request->date)->format('Y-m-d'));
     

      $id=auth::id();
      $search = $request->search ?? "";
 
  try{
   
  //  dd(Carbon::parse($request->date)->format('Y-m-d'));

      $sponsorstudentdata = 
            DB::table('sponsorrequesteds')
            ->join('users','users.id','=','sponsorrequesteds.stu_id')
            ->join('invoice','users.id','=','invoice.stu_id')
            ->join('courseselections','sponsorrequesteds.stu_id','=','courseselections.stu_id')
            ->join('payment','payment.stu_id','=','invoice.stu_id')
            ->join('courses','invoice.course_id','=','courses.id')
            ->select('sponsorrequesteds.stu_id','users.name','users.id','payment.amountdue','payment.balance_due','payment.ibs_reciept','invoice.course_id','invoice.invoiceno','invoice.updated_at','courses.name as course_name','payment.sponsor_accepted')
            ->when($request->date != null, function($q) use ($request){

                return $q->whereDate('invoice.updated_at',Carbon::parse($request->date)->format('Y-m-d'));
            })
            ->when($request->courseid != null, function($q) use ($request){

                return $q->where('invoice.course_id',$request->courseid);
            })
            ->when($request->search != null, function($q) use ($request){

                return $q->where('users.name','LIKE', '%'.$request->search.'%');
            })
            ->where('sponsorrequesteds.sponsor_id',auth::id())
            ->get();
            //dd($sponsorstudentdata);
      }
 catch(\Exception $exception){

    $courses = Courses::all();

     return view('front.sponsor.sponsorstudentviewerror',compact('courses'));
 }

 //dd($sponsorstudentdata);
     
   //  $studid = $sponsorstudentdata;
   //  $std = explode(',',$studid);
    
     

    $courses = Courses::all();


      

     // dd($search);
    
    
   //  dd($stdata);
     
        return view('front.sponsor.sponsorstudentview',compact('sponsorstudentdata','search','courses'));
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

        $id = auth::id();
        $courses = Courses::all();
        $search = $request->search ?? "";
        

        

        

      // Session::forget('courseid');

       $sponsoredstudentdata = DB::table('sponsoredstudents')
                ->join('users','users.id','=','sponsoredstudents.stu_id')
                ->join('invoice','invoice.stu_id','=','sponsoredstudents.stu_id')
                ->join('payment','payment.stu_id','=','invoice.stu_id')
                ->join('courses','courses.id','=','invoice.course_id')
                ->join('courseselections','courseselections.stu_id','=','sponsoredstudents.stu_id')
                ->select('sponsoredstudents.id','sponsoredstudents.stu_id','sponsoredstudents.sponsor_id','sponsoredstudents.request_accepted','users.name','users.id','payment.amountdue','payment.balance_due','payment.ibs_reciept','invoice.course_id','invoice.invoiceno','invoice.updated_at','courses.name as course_name','payment.sponsor_accepted')
                ->when(Session::get('date') != null, function($q) use ($request){

            return $q->whereDate('invoice.updated_at',Carbon::parse(Session::get('date'))->format('Y-m-d'));
        })
        ->when(Session::get('courseid') != null, function ($q) use ($request){

            return $q->where('invoice.course_id',Session::get('courseid'));
        })
        ->when($request->search != null, function($q) use ($request){

            return $q->where('users.name','LIKE', '%'.$request->search.'%');
        })
        ->where('sponsoredstudents.sponsor_id',$id)
        ->where('payment.balance_due','!=','0')
        ->get();

        
      //  dd($sponsoredstudentdata);

        return view('front.sponsor.sponsoredstudents',compact('sponsoredstudentdata','courses','search'))->with(Session::forget('date'))->with(Session::forget('course_id'));
       
       
    }
    public function confirmpaymentpost(Request $request){
         
      $filterdate = Session::put('date',$request->date);
      $filtercourse = Session::put('courseid',$request->courseid);

        $value = Sponsor::updateOrCreate([

            'id' =>auth::id()

        ],[


            'selected_stu_id' => Session::put('selected',json_encode($request->sponsored))
        ]);
         
        switch($request->paybutton){
            case 'online':
            return redirect()->route('onlinesponsorpayment');
            break;
            case 'offline':
            return redirect()->route('confirmsponsorpayment');
            break;  
            case 'filter':
                
            return redirect()->route('sponsoredstudents');
        }
        
}

    public function confirmsponsorpayment(Request $request){

     

        $selected = Session::get('selected');
       // dd($selected);
        
      $stu_id = json_decode($selected);

      $stid = implode(',',$stu_id);

      $der = explode(',',$stid);

     // if (($key = array_search('139', $der)) !== false) {
   //     unset($der[$key]);
  //  }

   // dd($der);

return view('front.sponsor.confirmsponsorpayment',compact('selected','stu_id','der'));

    }

    public function payrecieptpost(Request $request){

       
        if ($request->hasFile('payreciept')) {
            $fileName = $request->payreciept->getClientOriginalName();
            $path = $request->payreciept->move(public_path('/payreciept'), $fileName);
        }
        $recieptpost = paymentsession::Create([


            'sponsor_id' => auth::id(),
            'paid_stu_id' => json_encode($request->stu_id),
            'paid_reciept' =>$fileName
            
        ]);
    //    dd($request->payreciept);

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

    public function onlinesponsor(){

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

        return view('front.sponsor.onlinesponsorpayment',compact('selected','stu_id'));
    }
}
