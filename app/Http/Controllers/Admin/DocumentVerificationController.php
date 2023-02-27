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
use App\Models\Courseselection;
use App\Models\review;
use App\Models\Studentcourseoffer;
use App\Models\Document;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferEmail;
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
            if($this->id == 2 AND $this->id == 3)
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
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->select('users.name','users.updated_at','users.id','education.verification_status as verificationstatus','users.status','education.updated_at as reviewdate','education.cgpa')
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
     $users = DB::table('education')
     ->where('education.stu_id', $user->id)
     ->select('education.verification_status as verificationstatus')
     ->get();
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
     return view('admin.application.verify',compact('user','student_edu','cgpa','language','english','maths','economics','accounting','business','geography','history','legal','techno','practical','home','personal','courses','users'));
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

 
       $cgpa1 = array_sum($newarray)/$gradelength;

       $cgpa = number_format((float)($cgpa1), 2);

       //dd($cgpa);

       if($cgpa <= '2'){


        $courses = DB::table('courses')
        ->wherein('courses.field',['Business and Management','Information Technology'])
        ->select('courses.name','courses.id','courses.description','courses.institute')
        ->get();

       }
       elseif($cgpa >= '2.5'){


        $courses = DB::table('courses')
        ->wherein('courses.field',['Accounting and Finance','Economic and Development studies'])
        ->select('courses.name','courses.id','courses.description','courses.institute')
        ->get();
        

       }
       

       
     
      $courseoffer = Session::put('courseoffer', $courses);

    
    return redirect()->back()->with(compact('cgpa','language','english','maths','economics','accounting','business','geography','history','legal','techno','practical','home','personal','courses'));





    }
    
    public function send(Request $request)
    {


      switch($request->eligiblebutton){

        case 'send-eligibility':

        $cgpa = $request->cgpa;
        $courseid = $request->course_id;
        $somename = 'somename';
        $id = $request->stu_id;
        $student_edu =  Education::where('stu_id',$id)->get();
        $docum = new Document;
        $email = DB::table('users')->where('users.id',$id)->select('users.email','users.name')->get();
        $request->validate([


          'course_id' => 'required'

        ]);

        $courseselect = Courseselection::updateOrCreate([


          'stu_id' => $request->stu_id

        ],[


          'course_id' => json_encode($courseid),
          'offer_generated' => 1,
      
        ]);

        $review = review::create([

           'stu_id' => $request->stu_id,
          'cgpa' => $cgpa,
          'offer_id' => json_encode($courseid),


        ]);
        $course_offer=Studentcourseoffer::create([
          'stu_id'         => $request->stu_id,
          'offer_course_id'    => json_encode($courseid),
      ]);
      foreach($student_edu as $val)
            {
                $vals = array('stu_id'=>$val->stu_id,'edu_id'=>$val->id,'status'=> 2 );            
                $docum->create($vals);
                Education::where('id', $val->id)->update(array('verification_status' => 1,'cgpa' => $cgpa));            
            }
        //$id = 10;
        //$status = User::where('id', $id)->update(array('status' => 6));
        $data = array('uname'=>$email[0]->name,'offer'=>$somename);  
        Mail::to($email[0]->email)->send(new OfferEmail($data));
        //Mail::to('vedmanimoudgal@virtualemployee.com')->send(new OfferEmail($data));
        return redirect()->route('application.index');
        //->with('success','created successfully.');

          
          break;
          case 'save-sendlater':


          //  dd($request->stu_id);
            $docum = new Document;
            $id=$request->stu_id;
            $courseoffer = Session::get('courseoffer');
            $courseid = $request->course_id;
            $student_edu =  Education::where('stu_id',$id)->get();
            

             $request->validate([
              'course_id' => 'required',
       ]);
            $courseselection = Courseselection::create([


              'stu_id' => $id,
              'course_id' => json_encode($courseid),


            ]);
            foreach($student_edu as $val)
            {
                $vals = array('stu_id'=>$val->stu_id,'edu_id'=>$val->id,'status'=> 2 );            
                $docum->create($vals);
                Education::where('id', $val->id)->update(array('verification_status' => 3,'cgpa' => $cgpa));            
            }
            // $docum->stu_id =$request->stu_id;
            // $docum->status = $request->status;
            // $docum->edu_id = $request->edu_id;
            // $docum->save();
            $status = User::where('id', $id)->update(array('status' => 2));
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
      ->where('users.user_role',2)
      ->where('users.status',2)
      ->select('users.name','users.updated_at','users.id','education.verification_status as verificationstatus','users.status','education.updated_at as reviewdate','education.cgpa')
      ->whereBetween('users.updated_at',[$fromdate,$todate])
     ->get();

      
     
     //$educat = Document::all();
     $institute = DB::table('institute')->select('title','type','description')->get();
    return view('admin.application.index',compact('users','institute','fromdate','todate','search','university'));



    }

    
    public function searchname(Request $request){

      $search = $request->searchname;
      $fromdate = "NULL";
      $todate = "NULL";

      $users = DB::table('users')
      ->join('education','users.id','=','education.stu_id')
      ->select('users.name','users.updated_at','users.id','education.verification_status as verificationstatus','users.status','education.updated_at as reviewdate','education.cgpa')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->where('users.name','LIKE','%'.$search.'%')
     ->get();
     //$educat = Document::all();
     $institute = DB::table('institute')->select('title','type','description')->get();
    return view('admin.application.index',compact('users','institute','search','fromdate','todate'));



    }


    public function userexport(){




      return Excel::download(new ApplicationExport, 'applicationlist.xlsx');


    }





}
