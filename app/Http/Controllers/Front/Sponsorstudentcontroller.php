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

class Sponsorstudentcontroller extends Controller
{

    public function index(Request $request){


        $sponsorstudentdata = DB::table('sponsors')->join('users','users.id','=','sponsors.stu_id')->select('sponsors.stu_id','users.name','users.id')->where('sponsors.id',auth::id())->get();

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

        $sponsoredstudent = sponsoredstudents::all();

        foreach($sponsoredstudent as $sponsored){

            $sp = $sponsored->stu_id;

            
        }
    
        
      

     // dd($search);
    
    
   //  dd($stdata);
     
        return view('front.sponsor.sponsorstudentview',compact('sponsorstudentdata','std','search','student','sponsoredstudent','sp'));
    }


    public function sponsoredstudent(Request $request){


        $sponsoredstudent = sponsoredstudents::updateOrCreate([

            'stu_id' => $request->stu_id
        ],[

            
            'stu_id'=> $request->stu_id,
            'sponsor_id' => auth::id(),
            'request_accepted' => $request->request_accepted,

        ]);
        
        
        
        

        return redirect()->route('sponsorstudentview');


    }

    public function sponsoredstudentview(Request $request){

        $sponsoredstudentdata = sponsoredstudents::all();

    

        return view('front.sponsor.sponsoredstudents',compact('sponsoredstudentdata'));
    }
    public function history(){

        return view('front.sponsor.history');
    }

    public function confirmpaymentpost(Request $request){


        $value = Sponsor::updateOrCreate([

            'id' =>auth::id()

        ],[


            'selected_stu_id' => Session::put('selected',json_encode($request->sponsored))
        ]);
         
        

       
        return redirect()->route('confirmpayment');
    }

    public function confirmpayment(Request $request){

     

        $selected = Session::get('selected');
        
      $stu_id = json_decode($selected);

     foreach($stu_id as $key => $select){
 
     
        $valid=array($select);

        $student = DB::table('users')->where('users.id',$valid)
->join('sponsoredstudents','sponsoredstudents.stu_id','=','users.id')
->join('payment','users.id','=','payment.stu_id')
->join('invoice','users.id','=','invoice.stu_id')
->join('courses','invoice.course_id','=','courses.id')
->select('users.id','users.name','users.email','courses.name as course_name','invoice.updated_at','payment.amountdue','sponsoredstudents.stu_id','invoice.invoiceno')
->where('request_accepted','yes')->get();
     
dd($student);

}
       
       
        return view('front.sponsor.confirmpayment',compact('selected'));

    }
}
