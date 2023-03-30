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
use App\Models\selectedstusession;
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
            ->select('sponsorrequesteds.stu_id','users.name','users.id','payment.amountdue','payment.balance_due','payment.ibs_reciept','invoice.course_id','invoice.invoiceno','invoice.updated_at','courses.name as course_name','payment.sponsor_accepted','payment.invoice','courses.institute')
            ->when($request->date != null, function($q) use ($request){

                return $q->whereDate('invoice.updated_at',Carbon::parse($request->date)->format('Y-m-d'));
            })
            ->when($request->courseid != null, function($q) use ($request){

                return $q->where('invoice.course_id',$request->courseid);
            })
            ->when($request->institute != null, function($q) use ($request){

                return $q->where('courses.institute',$request->institute);
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
    $institute = DB::table('university')->get();

     return view('front.sponsor.sponsorstudentviewerror',compact('courses','institute'));
 }

 //dd($sponsorstudentdata);
     
   //  $studid = $sponsorstudentdata;
   //  $std = explode(',',$studid);
    
     

    $courses = Courses::all();
    $institute = DB::table('university')->get();

      

     // dd($search);
    
    
   //  dd($stdata);
     
        return view('front.sponsor.sponsorstudentview',compact('sponsorstudentdata','search','courses','institute'));
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
                ->select('sponsoredstudents.id','sponsoredstudents.stu_id','sponsoredstudents.sponsor_id','sponsoredstudents.request_accepted','users.name','users.id','payment.amountdue','payment.balance_due','payment.ibs_reciept','invoice.course_id','invoice.invoiceno','invoice.updated_at','courses.name as course_name','payment.sponsor_accepted','payment.invoice')
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

      //dd($request->sponsored);
         
        switch($request->paybutton){
            case 'online':
                $value = selectedstusession::updateOrCreate([


                    'sponsorid'  => auth::id()
                ],[
        
                    'sponsorid' => auth::id(),
                    'selstu' => json_encode($request->sponsored)
                ]);
            return redirect()->route('onlinesponsorpayment');
            break;
            case 'offline':
                $value = selectedstusession::updateOrCreate([


                    'sponsorid'  => auth::id()
                ],[
        
                    'sponsorid' => auth::id(),
                    'selstu' => json_encode($request->sponsored)
                ]);
            return redirect()->route('confirmsponsorpayment');
            break;  
            case 'filter':
                
            return redirect()->route('sponsoredstudents');
        }
        
}

    public function confirmsponsorpayment(Request $request){


     // dd(Session::get('dataVal'));
    
     
     $id = auth::id();
  

        $sel = selectedstusession::select('selstu')->where('sponsorid',$id)->get();

        $selected = $sel[0]->selstu;
       // dd($selected);
        
        
      $stu_id = json_decode($selected);

    // dd($stu_id);

      $stid = implode(',',$stu_id);

      $der = explode(',',$stid);
      
      $deselct = Session::get('deletedid');

     // dd($deselct);

     if( $deselct != null AND $deselct != "null"  ){

        //dd($deselct);
        

     $desel = json_decode($deselct);

      $ddl = implode(',',$desel);

      $deselctd = explode(',',$ddl);

       //dd($deselctd);

      $dest = array_diff($der,$deselctd);

     //dd($dest);
    
     // print_r($dest);
        
        $destr = selectedstusession::updateOrCreate([

            'sponsorid' => auth::id(),
        ],[

            'sponsorid' => auth::id(),
            'selstu' => $dest
        ]);
 
        //die();
       // dd($der);

      $updatedsel = selectedstusession::select('selstu')->where('sponsorid',$id)->get();

      

      $updatedselstu = $updatedsel[0]->selstu;

      $selstua = json_decode($updatedselstu);

      //dd($selstua);

       //$destrt = $destr->selstu;

      // dd($destrt);
      
      $des = $selstua;

    //  dd($des);

    }
    elseif($deselct = "null"){

        //dd($deselct);

       
      
      $des = $der;

    //  dd($des);

    }
    else{

        $des = $der;

    }
      


        //$des = \array_diff($der,$deselctd);

       

  //dd($des);
      
      $studentpayment = DB::table('users')
      ->whereIn('users.id',$des)
      ->join('sponsoredstudents','sponsoredstudents.stu_id','=','users.id')
      ->join('payment','users.id','=','payment.stu_id')
      ->join('invoice','users.id','=','invoice.stu_id')
      ->join('courses','invoice.course_id','=','courses.id')
      ->select('users.id','users.name','users.email','courses.name as course_name','invoice.updated_at','payment.balance_due','sponsoredstudents.stu_id','invoice.invoiceno','payment.status')
      ->where('request_accepted','yes')
      ->where('payment.balance_due','!=','0')
      ->get();



      
      //dd($studentpayment);

      //dump($student);

      

        
      //  dd($selectedforpayment);

     
    

     

          

   
   
return view('front.sponsor.confirmsponsorpayment',compact('studentpayment'))->with(Session::forget('deletedid'));




    }

    public function payrecieptpost(Request $request){

        switch($request->confirmsponsorpay){
            case 'deselect':
               
               $deselctd = Session::put('deletedid',json_encode($request->derid));
               
             //dd(Session::get('deletedid'));
               
            return redirect()->route('confirmsponsorpayment');
            break;
            case 'deselect2':
               
                $deselctd = Session::put('deletedid',json_encode($request->derid));
                
              //dd(Session::get('deletedid'));
                
             return redirect()->route('onlinesponsorpayment');
             break;
            case 'reciept':

                $request->validate([
                    'payreciept' => 'required'
                ]);
                
       
                if ($request->hasFile('payreciept')) {
                    $fileName = $request->payreciept->getClientOriginalName();
                    $path = $request->payreciept->move(public_path('/payreciept'), $fileName);
                }
                $recieptpost = paymentsession::Create([
        
        
                    'sponsor_id' => auth::id(),
                    'paid_stu_id' => json_encode($request->stu_id),
                    'paid_reciept' =>$fileName,
                    'amount_paid'  => array_sum($request->amount)
                    
                ]);
            //    dd($request->payreciept);

           
        
                $stu_id = $request->stu_id;
                $amount = $request->amount;

                $collection = collect($stu_id);
                $zipped = $collection->zip($amount);
                $zipped->toArray();

                foreach($zipped as $zip){

                $amountdue = payment::select('balance_due')->where('stu_id',$zip[0])->get();
                $amountpaid =  payment::select('amount_paid')->where('stu_id',$zip[0])->get();

                $paymentupdate = payment::updateOrCreate(
                                        [
                            
                                          'stu_id' => $zip[0]
                            
                                        ],[
                            
                                            'amount_paid' =>$zip[1] + $amountpaid[0]->amount_paid,
                                            'balance_due' =>   $amountdue[0]->balance_due - $zip[1],
                                            'status'   => 'waiting Reconcillation',
                                            'payreciept' => $fileName
                            
                                    ]);

                    
                }


               
               
//               foreach($stu_id as $stid){
        
//                $amountdue = payment::select('balance_due')->where('stu_id',$stid)->get();
 //               $amountpaid =  payment::select('amount_paid')->where('stu_id',$stid)->get();
        
//                $paymentupdate = payment::updateOrCreate(
//                    [
        
//                      'stu_id' => $stid
        
//                    ],[
        
//                        'amount_paid' =>$request->amount[0] + $amountpaid[0]->amount_paid,
//                        'balance_due' =>   $amountdue[0]->balance_due - $request->amount[0],
//                        'status'   => 'waiting Reconcillation',
        
//                ]);
        
//               }
               
               
               
              //  dd($paymentupdate);
        
        
         
              return redirect()->route('sponsorrecieptsubmitsuccess');
            break;  
            case 'cancel':
                
            return redirect()->route('sponsoredstudents');
            break;
        }
 

        

       
    }


    public function recieptsuccess(){


        return view('front.sponsor.sponsorrecieptsubmitsuccess');
    }


    public function history(){

        $id = auth::id();
        $paidstudents = DB::table('paymentsession')
        ->select('paymentsession.paid_reciept','paymentsession.amount_paid','paymentsession.updated_at')
        ->where('paymentsession.sponsor_id',$id)
        ->get();

    //dd($paidstudents);

        return view('front.sponsor.history',compact('paidstudents'));
    }

    public function onlinesponsor(){

        $id = auth::id();
  

        $sel = selectedstusession::select('selstu')->where('sponsorid',$id)->get();

        $selected = $sel[0]->selstu;
       //dd($selected);
        
        
      $stu_id = json_decode($selected);

    // dd($stu_id);

      $stid = implode(',',$stu_id);

      $der = explode(',',$stid);
      
     //dd($der);
      $deselct = Session::forget('deletedid');

      //dd($deselct);

     if( $deselct != null   ){

       // dd($deselct);
        

     $desel = json_decode($deselct);

      $ddl = implode(',',$desel);

      $deselctd = explode(',',$ddl);


      $dest = array_diff($der,$deselctd);

     // dd($ddl);
     // print_r($dest);
        
        $destr = selectedstusession::updateOrCreate([

            'sponsorid' => auth::id(),
        ],[

            'sponsorid' => auth::id(),
            'selstu' => $dest
        ]);
 
        //die();
       // dd($der);

      $updatedsel = selectedstusession::select('selstu')->where('sponsorid',$id)->get();


      $updatedselstu = $updatedsel[0]->selstu;

      $selstua = json_decode($updatedselstu);

      //dd($selstua);

       //$destrt = $destr->selstu;

      // dd($destrt);
      
      $des = $selstua;

    //  dd($des);

    }
    elseif($deselct = "null"){

        //dd($deselct);

       
      
      $des = $der;

    //  dd($des);

    }
    else{

        $des = $der;

    }
      


        //$des = \array_diff($der,$deselctd);

       

  // dd($des);
      
      $studentpayment = DB::table('users')
      ->whereIn('users.id',$des)
      ->join('sponsoredstudents','sponsoredstudents.stu_id','=','users.id')
      ->join('payment','users.id','=','payment.stu_id')
      ->join('invoice','users.id','=','invoice.stu_id')
      ->join('courses','invoice.course_id','=','courses.id')
      ->select('users.id','users.name','users.email','courses.name as course_name','invoice.updated_at','payment.balance_due','sponsoredstudents.stu_id','invoice.invoiceno','payment.status')
      ->where('request_accepted','yes')
      ->where('payment.balance_due','!=','0')
      ->get();



      
      //dd($studentpayment);

      //dump($student);

      

        
      //  dd($selectedforpayment);

        return view('front.sponsor.onlinesponsorpayment',compact('studentpayment'))->with(Session::forget('deletedid'));
    }
}
