<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Paymentgatewaycontroller extends Controller
{
    
    public function index(){


    }


    public function success(){


        return view('bspportal.success');


    }

    public function fail(){


        return view('bspportal.fail');
    }


    public function cancel(){



        return view('bspportal.cancel');

    }



    public function notify(){


        return view('bspportal.notify');

    }
}
