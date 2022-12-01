<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class Sponsorstudentcontroller extends Controller
{

    public function index(){


        $sponsorstudentdata = DB::table('sponsors')->join('users','users.id','=','sponsors.stu_id')->select('sponsors.stu_id','users.name','users.id')->where('sponsors.id',auth::id())->get();


        return view('front.sponsor.sponsorstudentview',compact('sponsorstudentdata'));
    }
}
