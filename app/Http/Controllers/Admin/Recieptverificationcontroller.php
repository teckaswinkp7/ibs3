<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use DB;

class Recieptverificationcontroller extends Controller
{
    
    public function index(){

        $users = DB::table('users')
        ->select('users.id','users.name','users.email')
        ->Join('payment','payment.stu_id','=','users.id')
        ->where('payment.status','waiting Reconcillation')
        ->get();

        return view('admin.reciept.index',compact('users'));
    }

    public function confirm(){

        $user = DB::table('users')
        ->select('users.id','users.name','users.email','users.phone')
        ->Join('payment','payment.stu_id','=','users.id')
        ->where('payment.status','waiting Reconcillation')
        ->get();

        $reciepts = Payment::all();

        return view('admin.reciept.confirm',compact('user','reciepts'));
    }


    public function store(Request $request){


        $id = DB::table('users')
        ->select('users.id')
        ->Join('payment','payment.stu_id','=','users.id')
        ->where('payment.status','waiting Reconcillation')
        ->get();

        $payment = payment::all();

       
foreach($id as $stuid){
            $reciept = payment::updateOrCreate([
               
                'stu_id' => $stuid->id
    
             ],[
                 
                
                'status' => $request->status
    
            ]);
           
        }

        $invocecopy = payment::create([

            'stu_id' => auth::id(),
            'amount_paid' =>$payment[0]->amount_paid,
            "payreciept" =>$payment[0]->payreciept,
            'balance_due' =>$payment[0]->balance_due,
            'status'   => $request->status,
        ]);

            

    return redirect()->route('reciept.index');

    }


    
}
