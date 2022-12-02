<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\sponsoredstudents;

class Sponsorstudentcontroller extends Controller
{

    public function index(Request $request){


        $sponsorstudentdata = DB::table('sponsors')->join('users','users.id','=','sponsors.stu_id')->select('sponsors.stu_id','users.name','users.id')->where('sponsors.id',auth::id())->get();

      $studid = $sponsorstudentdata[0]->stu_id;
      $std = explode(',',$studid);

      $search = $request->search ?? "";
      

     // dd($search);
    
    
   //  dd($stdata);
     
        return view('front.sponsor.sponsorstudentview',compact('sponsorstudentdata','std','search'));
    }


    public function sponsoredstudent(Request $request){


        $sponsoredstudent = sponsoredstudents::updateOrCreate([

            
            'stu_id'=> $request->stu_id,
            'sponsor_id' => auth::id(),
            'request_accepted' => $request->request_accepted,

        ]);

        return redirect()->route('sponsorstudentview');


    }

    public function sponsoredstudentview(){

        return view('front.sponsor.sponsoredstudents');
    }
}
