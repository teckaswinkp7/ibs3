<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\invoicelistExport;
use Maatwebsite\Excel\Facades\Excel;

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


    public function invoicedatesearch(Request $request){

         $fromdate = $request->fromdate;
         $todate = $request->todate;

        

        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->where('payment.amountdue','!=', NULL)
        ->whereBetween('users.updated_at',[$fromdate,$todate])
        ->get();

        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();



        return view('admin.reports.invoicelist',compact('paymentlist','paymentcount'));
    }

    public function invoicesearch(Request $request){

        $search = $request->search;
       

       $paymentlist = User::where('users.offer_accepted','yes')
       ->join('payment','users.id','payment.stu_id')
       ->join('courseselections','users.id','courseselections.stu_id')
       ->join('courses','courseselections.studentSelCid','courses.id')
       ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
       ->where('payment.amountdue','!=', NULL)
       ->where('users.name','LIKE','%'.$search.'%')
       ->orWhere('courses.name','LIKE','%'.$search.'%')
       ->get();

       $paymentcount = User::where('users.offer_accepted','yes')
       ->join('payment','users.id','payment.stu_id')
       ->join('courseselections','users.id','courseselections.stu_id')
       ->join('courses','courseselections.studentSelCid','courses.id')
       ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
       ->count();



       return view('admin.reports.invoicelist',compact('paymentlist','paymentcount'));
   }

   public function invoicelistExport(Request $request){



    return Excel::download(new InvoicelistExport,'invoicelist.xlsx');

}
}
