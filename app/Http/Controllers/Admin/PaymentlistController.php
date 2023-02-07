<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  DB;
use App\Models\User;
use App\Exports\PaymentlistExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentlistController extends Controller
{
    

    public function index(){


        $fromdate = "NULL";
        $todate = "NULL";
        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->get();
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount','fromdate','todate'));


    }



    public function paymentlistdatesearch(Request $request){



        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->whereBetween('users.updated_at',[$fromdate,$todate])
        ->get();
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount','fromdate','todate'));


    }

    
    public function paymentlistnamesearch(Request $request){



        $search = $request->search;
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->where('users.name','LIKE','%'.$search.'%')
        ->orWhere('courses.name','LIKE','%'.$search.'%')
        ->get();
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount'));


    }


    public function exportpaymentlist(Request $request){



        return Excel::download(new PaymentlistExport,'paymentlist.xlsx');

    }
}
