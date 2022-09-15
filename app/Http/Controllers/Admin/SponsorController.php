<?php

namespace App\Http\Controllers\Admin;
use App\Models\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;


class SponsorController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['sponsorDetails'] = Sponsor::select('users.name as student_name','courses.name as course_name','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->get();   
    return view('admin\sponsor.index', $data);    
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    
    
}
