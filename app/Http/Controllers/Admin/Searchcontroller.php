<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class Searchcontroller extends Controller
{
    


    public function index(Request $request){
        
 $query = $request->search;



 $paymentlist =  DB::table('users')
 ->where('users.user_role','2')
 ->leftjoin('courses','users.id','=','courses.id')
 ->leftjoin('payment','payment.stu_id','=','users.id')
 ->leftjoin('courseselections','courseselections.studentSelCid','=','courses.id')
 ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename','users.offer_accepted')
        ->where('users.name','LIKE','%'.$query.'%')
        ->orwhere('users.email','LIKE','%'.$query.'%')
        ->paginate(5);


return view('admin.reports.search',compact('query','paymentlist'));

}

}
