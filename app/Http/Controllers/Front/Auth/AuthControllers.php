<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Role;
use App\Models\Courses;
use App\Models\Education;
use App\Models\Courseselection;
use App\Mail\SendEmail;
use App\Models\Studentcourse;
use App\Models\Studentcourseoffer;
use Illuminate\Support\Facades\Mail;
use Hash;
class AuthControllers extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('front\auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('front\auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if ((Auth::attempt($credentials))&&(Auth::user()->is_email_verified == 1)) {  
            
            return redirect("dashboard")->with('Oppes! You have entered invalid credentials');  
                    
        }
  
        return redirect("login")->with('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'phone'=> 'required|digits:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        $subject="Registered User";
        $otp = rand(1000,9999);
        $user = User::where('email','=',$request->email)->update(['otp' => $otp]);
        
        if($user){
            $data = array('otp' => $otp,'email' =>$request->email);
            Mail::to($request->email)->send(new SendEmail($data));
            return view('front/verifyotp')->with($data);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }

    public function validateOtp(Request $request){
        
        $otp = $request->input('otp');
        $user  = User::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
        if($user){

           $verified=date("Y-m-d H:i:s", strtotime('now'));
           $users= User::where('email','=',$request->email)->update(['email_verified_at' =>$verified,'is_email_verified' => 1]);
           return redirect("login");
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }
    public function resendOtp(Request $request)
    {
        $otp = rand(1000,9999);
        $user = User::where('email','=',$request->email)->update(['otp' => $otp]);
        if($user){
            $data = array('otp' => $otp,'email' =>$request->email);
            Mail::to($request->email)->send(new SendEmail($data));
            return view('front/verifyotp')->with($data);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }
    

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            if(Auth::user()->is_email_verified == 1){  
            $id = Auth::user()->id;
            $student_edu = Education::where('stu_id',$id)->get(); 
            $course_select = Courseselection::where('stu_id',$id)->pluck('course_id');
            $student_course_offer=Studentcourseoffer::where('stu_id',$id)->get();
            $course_selects=$course_select[0];
            $course_sel=json_decode($course_selects);
            foreach ($course_sel as $key => $value) {
                $course_final_select[] = Courses::where('id',$value)->pluck('name');
            } 
            $studentcourse=Studentcourse::where('stu_id',$id)->get();
            return view('front/dashboard',compact('student_edu','course_final_select','course_sel','student_course_offer','studentcourse'));
        }
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function profile()
    {
        
        return view('front/profile');
            
    }
    public function studentCoursestore(Request $request)
    {

        $docum = new Studentcourse;
        $course = $request->all();
        $studentcourse=Studentcourse::create([
            'stu_id'         => $request->stu_id,
            'student_course_id'    => $request->student_course_id,
        ]);
        $studentcourseId = $studentcourse->id;
        $status = Studentcourse::where('id', $studentcourseId)->update(array('status' => 1));
        return redirect()->route('dashboard')
        ->with('success','created successfully.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'phone' => $data['phone'],
        'user_role' => '1',
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    public function approve($id){
        $status = Studentcourseoffer::where('id', $id)->update(array('status' => 1));
        return redirect()->back(); 
    }
     
    public function decline($id){
        $status = Studentcourseoffer::where('id', $id)->update(array('status' => 0));
        return redirect()->back();
    }
}
