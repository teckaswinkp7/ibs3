<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Education;
use DB;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
class Reportingcontroller extends Controller
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

    public function index(){

        $data1['role']= Role::all();
        DB::statement("SET SQL_MODE=''");
        $registeredstudents = User::where('users.user_role', 2)->join('education', 'education.stu_id','=','users.id')->groupBy('users.id')       
        ->get();

        return view('admin.reports.document_submitted',$data1,compact('registeredstudents'));
    }

    public function offer(){

        $data1['role']= Role::all();
        DB::statement("SET SQL_MODE=''");
        $registeredstudents = User::where('users.user_role', 2)->where('courseselections.offer_generated',1)->join('courseselections', 'courseselections.stu_id','=','users.id')->join('courses','courses.id','=','courseselections.studentSelCid')->groupBy('users.id')      
        ->select('users.*','courseselections.*','courses.name as cname')->get();
        //check
        return view('admin.reports.offered',$data1,compact('registeredstudents'));
    }

    public function offer_accepted(){

        $data1['role']= Role::all();
        DB::statement("SET SQL_MODE=''");
        $registeredstudents = DB::table('users')
        ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
        ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
        ->where('user_role', 2)
        ->groupBy('users.id')  
        
        ->select('users.*','courses.name as coursename') 
        ->paginate(5);

        
    
        return view('admin.reports.offer_accepted',$data1,compact('registeredstudents'));
    }




    public function searchofferaccepted(Request $request){


        $fromdate = $request->fromdate;
        $todate = $request->todate;

       

        $registeredstudents = User::select('users.*')
        ->where('user_role', 2)
        ->whereBetween('users.updated_at',[$fromdate,$todate])
        ->groupBy('users.id')      
        ->paginate(5);


        return view('admin.reports.offer_accepted',compact('registeredstudents'));



    }


    public function namesearchofferaccepted(Request $request){


        $search = $request->search;

       

        $registeredstudents = User::select('users.*')
        ->where('user_role', 2)
        ->where('users.name', 'LIKE','%'.$search.'%')
        ->groupBy('users.id')      
        ->paginate(5);


        return view('admin.reports.offer_accepted',compact('registeredstudents'));



    }


    public function exportUsers(Request $request){
        
        
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function sent_invoice(){

        $data1['role']= Role::all();
        DB::statement("SET SQL_MODE=''");
        $registeredstudents = User::where('user_role', 2)->where('courseselections.invoice_sent',1)->join('courseselections', 'courseselections.stu_id','=','users.id')->join('courses','courses.id','=','courseselections.studentSelCid')->groupBy('users.id')       
        ->select('users.*','courseselections.*','courses.name as cname')->get();
        
        return view('admin.reports.invoice_sent',$data1,compact('registeredstudents'));
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */

    public function show(Request $request,$id)
    {
    //$role = Role::all();
    
    $user = User::findOrFail($id);
    $student_edu = Education::where('stu_id',$id)->get();          
    return view('admin.reports.show',compact('user','student_edu'));
    } 
}
