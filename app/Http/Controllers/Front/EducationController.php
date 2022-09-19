<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\User;
use App\Models\Sponsor;
use App\Models\Studentcourseoffer;
use App\Models\Bankdetails;
use App\Models\Studentcourse;
use App\Models\Courseselection;
use Illuminate\Support\Facades\Validator;
use Session;
class EducationController extends Controller
{
	/**
     * Display a listing of the prducts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::all();

        //return view('products.index',compact('products'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepOne(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->get();
        return view('front/education.create-step-one',compact('user'));
        //return view('front/education.create-step-one');
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
        ]);

        if(empty($request->session()->get('user'))){
            $user = new User();
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }else{
            $user = $request->session()->get('user');
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }

        return redirect()->route('education.create.step.two');
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepTwo(Request $request)
    {
        //$education = $request->session()->get('education');
        return view('front/education.create-step-two');
        //return view('front/education.create-step-two',compact('education'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepTwo(Request $request)
    {
    	/*$validatedData = $request->validate([
            'board' => 'required',
            'percentage' => 'required',
        ]);

        if(empty($request->session()->get('education'))){
            $education = new Education();
            $education->fill($validatedData);
            $request->session()->put('education', $education);
        }else{
            $education = $request->session()->get('education');
            $education->fill($validatedData);
            $request->session()->put('education', $education);
        }*/
        
        /*$validator = Validator::make($request->all(), [
            'board' => 'required',
            'percentage' => 'required',
            
        ]);*/
        $edu = new Education;
        $size = count(collect($request)->get('qualification'));
        //$size = count(collect($request)->get('document'));
        //dd($size);
        for ($i = 0; $i < $size; $i++)
            {
                //
                $education = new Education;
                $id = Auth::id();
                $education->stu_id =$id;
                $education->qualification = $request->get('qualification')[$i];
                $education->board = $request->get('board')[$i];
                $education->percentage = $request->get('percentage')[$i];
                if($request->file('document')){
                    $file= $request->file('document')[$i];
                    $filename= rand(10,100).$file->getClientOriginalName();
                    $file-> move(public_path('public/Image'), $filename);
                    $education->document= $filename;
                }
                $education->save();                  
            }
            $status = User::where('id', $id)->update(array('status' => 2));
            return redirect()->route('dashboard');   
            /*$file= $request->file('document');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $edu->document = $filename;*/
            //return response()->json(['success'=>'Added new records.']);
         
  
    }

    public function insert_sponsor(Request $request)
    {
        $id = Auth::id();
        $val = Sponsor::create([
            'sponsor_name'    => $request->sponsor_name,
            'sponsor_email'   => $request->sponsor_email,
            'sponsor_phone'   => $request->sponsor_phone,
            'course_id'       => $request->course_id,
            'stu_id'          => $id               
        ]);
        if($val)
        {
            return redirect()->route('education.course.offer')
            ->with('success','Sponsor Inserted successfully.');
        }
        else
        {
            return redirect()->route('education.course.offer')
            ->with('danger','Error during sponsor insertion');
        }
        
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepThree(Request $request)
    {
        $product = $request->session()->get('product');

        return view('education.create-step-three',compact('product'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepThree(Request $request)
    {
    	$product = $request->session()->get('product');
        $product->save();

        $request->session()->forget('product');

        return redirect()->route('education.index');
    }

    public function getCourseOffers()
    {
        $id = Auth::id();
        $student_course_offer= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id",            
            "courses.name as courses_name",
            "courses.price",
            "studentcourseoffers.course_offer_description",
            "courseselections.offer_accepted",
            "courseselections.invoice_sent",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->join("studentcourseoffers","studentcourseoffers.stu_id", "=", "studentcourses.stu_id")
        ->join("courseselections","courseselections.stu_id", "=", "studentcourses.stu_id")
        ->where('studentcourses.stu_id','=',$id)
        ->get(); 

        $bankdetails = Bankdetails::findOrFail(1);  
    	$userData = Studentcourseoffer::where('stu_id', $id)->get();
        //dd($userData);
        //dd($student_course_offer);
        return view('front\education\course-offer',compact('student_course_offer','userData','bankdetails'));
        //return redirect()->route('education.course.offer','userData','student_course_offer');
    }

    public function upload_invoice(Request $request)
    {
        $id = Auth::id();
        if($request->file('receipt')){
            $file= $request->file('receipt');
            $filename= time().rand(1000,9999).$file->getClientOriginalName();
            $file->move(public_path('public/uploads/receipt'), $filename);
            //$category->cat_image= $filename;
            
            $status = Courseselection::where('stu_id', $id)->update(array('receipt' => $filename));
            //dd($status == 1);
            if($status)
            {
                Session::flash('message', 'File uploaded successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('education/course-offer');
            }
            else
            {
                Session::flash('message', 'Error during upload!'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('education/course-offer');
            }
        }

    }

    public function upload_invoice_sponsor(Request $request)
    {
        $id = $request->stu_id;
        if($request->file('receipt')){
            $file= $request->file('receipt');
            $filename= time().rand(1000,9999).$file->getClientOriginalName();
            $file->move(public_path('public/uploads/receipt'), $filename);
            //$category->cat_image= $filename;
            
            $status = Courseselection::where('stu_id', $id)->update(array('receipt' => $filename));
            //dd($status == 1);
            if($status)
            {
                Session::flash('message', 'File uploaded successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('education/view-student');
            }
            else
            {
                Session::flash('message', 'Error during upload!'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('education/view-student');
            }
        }

    }

    public function getStudents()
    {
        $id = Auth::id();
        $email = Auth::user()->email;
        $data['student_course_offer']= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id",            
            "courses.name as courses_name",
            "courses.price",            
            "courseselections.offer_accepted",
            "courseselections.invoice_sent",
            "courseselections.invoice",
            "users.name",
            "users.email",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->join("studentcourseoffers","studentcourseoffers.stu_id", "=", "studentcourses.stu_id")
        ->join("courseselections","courseselections.stu_id", "=", "studentcourses.stu_id")
        ->join("users","users.id","=","courseselections.stu_id")
        //->where('studentcourses.stu_id','=',$id)
        ->get(); 
        $data['sponsorDetails'] = Sponsor::select('users.name as student_name','users.email','courses.name as course_name','courses.price','courseselections.offer_accepted','courseselections.invoice_sent','courseselections.invoice','courseselections.receipt','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt',null)->get(); 
        $data['priceTotal'] = Sponsor::join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt',null)->sum('courses.price'); 
        $data['studentTotal'] = Sponsor::join('users','users.id', '=','sponsors.stu_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt',null)->count('users.id'); 
        $data['bankdetails'] = Bankdetails::findOrFail(1); 
        //$data['users'] = User::where('user_role',2)->get();
        //dd($data['sponsorDetails']);
        return view('front\education\student',$data);
        
    }

    public function getsponseredStudents()
    {
        $id = Auth::id();
        $email = Auth::user()->email;
        
        $data['sponsorDetails'] = Sponsor::select('users.name as student_name','users.email','courses.name as course_name','courses.price','courseselections.offer_accepted','courseselections.invoice_sent','courseselections.invoice','courseselections.receipt','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt','!=','')->get();        
       
        //$data['users'] = User::where('user_role',2)->get();
        //dd($data['sponsorDetails']);
        return view('front\education\sponsered-student',$data);
        
    }

    public function sponsor_pay($id)
    {
        $email = Auth::user()->email;
        $sponsor_id = Auth::id();
        $student_id = $id;
        $data['sponsorDetails'] = Sponsor::select('users.name as student_name','users.email','courses.name as course_name','courses.price','courseselections.offer_accepted','courseselections.invoice_sent','courseselections.invoice','courseselections.receipt','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('users.id',$student_id)->first(); 
        $data['bankdetails'] = Bankdetails::findOrFail(1); 
        //dd($data['sponsorDetails']);
        return view('front\education\sponsor-payment',$data);
    }    
    
}
