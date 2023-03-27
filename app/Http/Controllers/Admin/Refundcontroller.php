<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  DB;
use App\Models\User;
use App\Models\Payment;

class Refundcontroller extends Controller
{
    

    public function index(){

        
        $fromdate = "NULL";
        $todate = "NULL";
        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->where('payment.refundrequest','yes')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename')
        ->get();
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->where('payment.refundrequest','yes')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();
  
    



        return view('admin.refund.index',compact('paymentlist','paymentcount','fromdate','todate'));
    }
}
