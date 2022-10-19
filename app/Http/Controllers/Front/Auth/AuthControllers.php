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
        return view('front.auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        //return view('front.auth.registration');
        return view('front.auth.register');
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
            $userid = Auth::id();
            $user = User::where('id','=',$userid)->first();
            //dd($userRole);
            if($user->user_role == 3)
            {
                //return redirect("dashboard")->with('Oppes! You have entered invalid credentials'); 
                return redirect("dashboard"); 
            }
            else
            {
                return redirect("education/create-step-one"); 
            }                    
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
        //dd($request);
        $request->validate([
            'name' => 'required',
            'phone'=> 'required|digits:10',
            //'user_role'=> 'required',
            'email' => 'required|email|unique:users',
            //'password' => 'required|min:6',
        ]);
           
        $data = $request->all();        
        //Session::put('pass', $request->password);
        Session::put('uname', $request->name);
        Session::put('email', $request->email);
        Session::put('phone', $request->phone);
        //$check = $this->create($data);
        $subject="Registered User";
        $otp = rand(1000,9999);
        Session::put('otp', $otp);
        //$user = User::where('email','=',$request->email)->update(['otp' => $otp]);
        $user = User::where('email','=',$request->email)->get();
        
        if(!empty($user)){
            $data = array('otp' => $otp,'email' =>$request->email);
            Mail::to($request->email)->send(new SendEmail($data));
            //return view('front.verifyotp')->with($data);
            return view('front.auth.otp')->with($data);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }

    public function validateOtp(Request $request){
        
        $otp = $request->input('otp');
        
        $user  = User::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
        //if($user){
        if(Session::get('otp') == $otp)
        {
            
           /*$verified=date("Y-m-d H:i:s", strtotime('now'));
           $users= User::where('email','=',$request->email)->update(['email_verified_at' =>$verified,'is_email_verified' => 1]);
           $credentials = array('email'=>$request->email,'password'=>Session::get('pass'));
           //dd($users);
           Auth::attempt($credentials);
           if(Auth::user()->user_role == 3)
           {
            return redirect("dashboard");
           }
           else
           {
            return redirect("education/create-step-one");
           }
           Session::put('pass', '');*/
           //return redirect("login");
           
           //return redirect("setpassword");
           //return redirect()->route('setpassword');
           
           //return view('front.auth.set_password');
           return view('front.auth.set_passworddds');
        }
        else{
            //return view('front.auth.set_passworddds');
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }

    public function set_password()
    {
        echo 'Ved';

        return view('front.auth.set_password');
    }
    public function resendOtp(Request $request)
    {
        $otp = rand(1000,9999);
        // $user = User::where('email','=',$request->email)->update(['otp' => $otp]);
        // if($user){
        $email = Session::get('email');
        $data = array('otp' => $otp,'email' =>$email);
        if(Mail::to($email)->send(new SendEmail($data)))
        {
        return view('front.otp')->with($data);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }
    
    public function confirm_register(Request $request)
    {
        
        /*$request->validate([            
            'user_role'=> 'required',           
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
            'user_role' => 'required',
        ]);*/
        //dd($request);   
        $data = $request->all();        
        //Session::put('pass', $request->password);
        $name = Session::get('uname');
        $email = Session::get('email');
        $phone = Session::get('phone');
        $otp = Session::get('otp');
        $data = array('name'=>$name,'phone'=>$phone,'email'=>$email,'password'=>$request->password,'user_role'=>$request->user_role,'is_email_verified'=>1);
        $check = $this->create($data);
        //dd($check);
        $user = User::where('email','=',$email)->update(['otp' => $otp]);

        $credentials = array('email'=>$email,'password'=>$request->password);
        //dd($credentials);
        $val = Auth::attempt($credentials);
        //dd($val);

        if(Auth::user()->user_role == 3)
        {
        return redirect("dashboard");
        }
        else
        {
        return redirect("education/create-step-one");
        }
        Session::put('pass', '');
        Session::put('uname', '');
        Session::put('email', '');
        Session::put('phone', '');
        Session::put('otp', '');
        
        /*if($user){
            $data = array('otp' => $otp,'email' =>$request->email);
            Mail::to($request->email)->send(new SendEmail($data));
            return view('front.verifyotp')->with($data);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }*/
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
                return view('front.dashboard');
            }
        }
        
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

  

    public function profile()
    {
        
        return view('front.profile');
            
    }
    public function studentCoursestore(Request $request)
    {

        $id = Auth::id();
        $studentSelCid = $request->student_course_id;
        $status = Courseselection::where('stu_id', $id)->update(array('studentSelCid' => $studentSelCid));
       
        $studentcourse=Studentcourse::create([
            'stu_id'            => $id,
            'student_course_id' => $studentSelCid,
            'status'            =>1,
        ]);
        Session::flash('message', 'You will get the course offer soon!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('dashboard');
        
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
        'user_role' => $data['user_role'],
        'status' =>'1',
        'email' => $data['email'],  
        'password' => Hash::make($data['password']),
        'is_email_verified' =>1
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

    public function approve_course()
    {
        $id = Auth::id();
        $status = Courseselection::where('stu_id', $id)->update(array('offer_accepted' => 1));
        return redirect()->back(); 
    }

    public function deny_course()
    {
        $id = Auth::id();
        $status = Courseselection::where('stu_id', $id)->update(array('offer_accepted' => 2,'offer_generated'=>0));
        return redirect()->back(); 
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
