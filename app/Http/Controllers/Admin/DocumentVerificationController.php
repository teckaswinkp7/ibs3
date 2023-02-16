<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Courses;
use App\Models\Role;
use App\Models\Education;
use App\Models\Document;
use Hash;
use DB;
use App\Exports\ApplicationExport;
use Maatwebsite\Excel\Facades\Excel;

class DocumentVerificationController extends Controller
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
    //
    public function index()
    {



      $fromdate = "NULL";
      $todate = "NULL";
      $search ="NULL";
      $university = "NULL";
     

     $users = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->get();

     $institute = DB::table('institute')->select('title','type','description')->get();
     //$educat = Document::all();
    return view('admin.application.index',compact('users','institute','fromdate','todate','university'));
    }
    public function verify($id)
    {
     //$data['categories'] = Category::orderBy('id','desc')->paginate(5)
     //$data['users'] = User::all();
     //$data1['role']= Role::all();
     //$data['users'] = User::where('user_role',2) ->get();
     $user = User::findOrFail($id);  
     //$student_edu =  Education::join('documents','documents.edu_id','education.id')->where('education.stu_id',$id)->where('documents.status',1)->get();   
     $student_edu =  Education::where('stu_id',$id)->where('verification_status',null)->get();
     //dd($student_edu);  
     $language = Session::get('language');
     $english = Session::get('english');
     $maths = Session::get('maths');
     $economics = Session::get('economics');
     $accounting = Session::get('accounting');
     $business = Session::get('business');
     $geography = Session::get('geography');
     $history = Session::get('history');
     $legal = Session::get('legal');
     $techno = Session::get('techno');
     $practical = Session::get('practical'); 
     $home = Session::get('home');
     $personal = Session::get('personal');
     $cgpa = Session::get('cgpa');
     $courses = Session::get('courses');
     return view('admin.application.verify',compact('user','student_edu','cgpa','language','english','maths','economics','accounting','business','geography','history','legal','techno','practical','home','personal','courses'));
    }


    public function obtain(Request $request){

        $id = auth::id();
        $language = $request->language;
        $english = $request->english;
        $maths = $request->maths;
        $economics = $request->economics;
        $accounting = $request->accounting;
        $business = $request->business;
        $geography = $request->geography;
        $history = $request->history;
        $legal = $request->legal;
        $techno = $request->techno;
        $practical = $request->practical;
        $home = $request->home;
        $personal = $request->personal;
        

        
        
        

  $array = [$language,$english,$maths,$economics,$accounting,$business,$geography,$history,$legal,$techno,$practical,$home,$personal];
 $gradelength = count($array);
 $a=$array;

       
       $newarray = (array_map(function($v){
        if ($v==="A")
        {
        return "5";
        }
      elseif($v === "B"){

        return "4";
      }
      elseif($v === "C"){
        return "3";
      }
      elseif($v === "D"){

        return "2";
      }
      elseif($v === "E"){

        return "1";
      }
      elseif($v === "F"){
        return "0";
      }
      return $v;

       },$a));

 
       $cgpa = array_sum($newarray)/$gradelength;

      

       if($cgpa <= '5'){


        $courses = DB::table('courses')->where('courses.field','Accounting and Finance')->select('courses.name')->get();

       }

     

    
    return redirect()->back()->with(compact('cgpa','language','english','maths','economics','accounting','business','geography','history','legal','techno','practical','home','personal','courses'));





    }
    
    public function send(Request $request)
    {


      switch($request->eligiblebutton){

        case 'send-eligibility':
          $data['invoice_id'] = '#INV-'.time();
        $inv_id = $data['invoice_id'];
        $id= $request->stu_id; 
        $data['custom_price']= $request->custom_price; 
        $data['users'] = User::where('id',$id)->get();        
        $uid=(int) $id;        
        $data['student_course_invoice']= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id", 
            "courses.name as courses_name",
            "courses.price"
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->where('studentcourses.stu_id','=',$uid)
        ->get();

        $path = public_path('uploads/attachment');        
        $pdf = PDF::loadView('admin.myofferPDF',$data);
        $filename= time().'_'.rand(0000,9999).'_'.'Offer.pdf';    
        $ac = $pdf->save($path.'/'.$filename);
        

        $offer = new Studentcourseoffer;
        $course_offer = $request->all();
        $offer=$request->course_offer_description;
        $cust_price = $request->custom_price; 

        $course_offer=Studentcourseoffer::create([
            'stu_id'         => $request->stu_id,
            'offer_course_id'    => $request->offer_course_id,
            'course_offer_description'    => $request->course_offer_description,
        ]);
        $id=$request->stu_id;
        //$id = 10;
        //$status = User::where('id', $id)->update(array('status' => 6));
        $status = Courseselection::where('stu_id', $id)->update(array('offer_generated' => 1,'custom_offer_price'=>$cust_price,'offer' => $filename));
        $data = array('offer_desc'=>"$request->course_offer_description",'offer'=> $offer,'filename'=>$filename);  
        Mail::to($request->stu_email)->send(new OfferEmail($data));
        //Mail::to('vedmanimoudgal@virtualemployee.com')->send(new OfferEmail($data));
        return redirect('admin/studentcourse');
        //->with('success','created successfully.');

          
          break;
          case 'save-sendlater':


            $docum = new Document;
            $id=$request->stu_id;
            $student_edu =  Education::where('stu_id',$id)->get();
            foreach($student_edu as $val)
            {
                $vals = array('stu_id'=>$val->stu_id,'edu_id'=>$val->id,'status'=>$request->status);            
                $docum->create($vals);
                Education::where('id', $val->id)->update(array('verification_status' => $request->status));            
            }
            // $docum->stu_id =$request->stu_id;
            // $docum->status = $request->status;
            // $docum->edu_id = $request->edu_id;
            // $docum->save();
            $status = User::where('id', $id)->update(array('status' => 3));
            return redirect()->route('application.index')
            ->with('success','created successfully.');

       
    }
  }



    public function search(Request $request){


      $fromdate = $request->fromdate;
      $todate = $request->todate;
      $search = "NULL";
      $university = $request->university;

      $users = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->join('courseselections','courseselections.stu_id','=','users.id')
     ->join('courses','courses.id','=','courseselections.studentSelCid')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->whereBetween('education.updated_at',[$fromdate,$todate])
     ->orWhere('courses.university',$university)
     ->get();
     //$educat = Document::all();
     $institute = DB::table('institute')->select('title','type','description')->get();
    return view('admin.application.index',compact('users','institute','fromdate','todate','search','university'));



    }

    
    public function searchname(Request $request){

      $search = $request->searchname;

      $users = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->where('users.name','LIKE','%'.$search.'%')
     ->get();
     //$educat = Document::all();
     $institute = DB::table('institute')->select('title','type','description')->get();
    return view('admin.application.index',compact('users','institute','search'));



    }


    public function userexport(){




      return Excel::download(new ApplicationExport, 'applicationlist.xlsx');


    }





}
