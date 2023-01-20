<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;


class Enrolmentcontroller extends Controller
{
    
    public function index(){


        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->get();



        return view('admin.reports.manageenrollments',compact('paymentlist'));


    }
}
