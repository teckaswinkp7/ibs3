<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class Invoicelistcontroller extends Controller
{


    public function index(){


        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->where('payment.amountdue','!=', NULL)
        ->get();

        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();



        return view('admin.reports.invoicelist',compact('paymentlist','paymentcount'));
    }
}
