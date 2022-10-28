<?php

namespace App\Http\Controllers\Admin;
use App\Models\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;


class SponsorController extends Controller
{
    public function __construct() {       
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->user_role;
            if($this->id != 1)
            {
                return redirect('unauthorized');
                die();
            }
            else{
                return $next($request);
            }
            
        });
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['sponsorDetails'] = Sponsor::select('users.name as student_name','courses.name as course_name','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->get();   
    return view('admin.sponsor.index', $data);    
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    
    
}
