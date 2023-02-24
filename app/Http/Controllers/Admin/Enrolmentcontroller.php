<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Exports\EnrolledUser;
use Maatwebsite\Excel\Facades\Excel;


class Enrolmentcontroller extends Controller
{
    
    public function index(){


        $paymentlist= DB::table('users')
        ->where('users.user_role','2')
        ->leftjoin('courses','users.id','=','courses.id')
        ->leftjoin('payment','payment.stu_id','=','users.id')
        ->leftjoin('courseselections','courseselections.studentSelCid','=','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename','users.offer_accepted')
        ->paginate(5);
       

        //dd($paymentlist);


        return view('admin.reports.manageenrollments',compact('paymentlist'));


    }

    public function searchnameenrollment(Request $request){



        $search = $request->search;

        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->where('users.name','LIKE','%'.$search.'%')
        ->get();



        return view('admin.reports.manageenrollments',compact('paymentlist'));


    }



    public function EnrolledUsers(Request $request){
        
        
        return Excel::download(new EnrolledUser,'enrolledusers.xlsx');
    }
}
