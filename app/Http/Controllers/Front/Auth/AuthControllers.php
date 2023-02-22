<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Role;
use App\Models\Courses;
use App\Models\Sponsor;
use App\Models\Education;
use App\Models\Courseselection;
use App\Mail\SendEmail;
use App\Mail\sponsorcredentials;
use App\Models\Studentcourse;
use App\Models\Studentcourseoffer;
use App\Models\Profile;
use Illuminate\Support\Facades\Mail;
use Hash;
use DB;
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
      $validation =   $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        if ((Auth::attempt($credentials))&&(Auth::user()->is_email_verified == 1)) {  
            $userid = Auth::id();
            $user = User::where('id','=',$userid)->first();
            //dd($user->user_role);
            DB::table('active_users')->insert(array('user_id' =>   Auth::id()));
           
            if($user->user_role == 3)
            {
                //return redirect("dashboard")->with('Oppes! You have entered invalid credentials'); 
                return redirect("sponsorprofile"); 
            }

            else if($user->user_role == 2)
            {
                //return redirect("dashboard")->with('Oppes! You have entered invalid credentials'); 
                
                //return redirect('education/create-step-two'); 
                return redirect('userprofile'); 
                //return redirect('education/docstatus'); 
            }
            else
            {
                return redirect("admin/dashboard"); 
            }                    
        }

        if ($validation) { 

            return redirect()->back()->withErrors(
                [
                    'password' =>'Invalid Credentials!!'
                ]
            );
        }
  
        
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
        //echo 'Ved';

        return view('front.auth.set_password');
    }

    public function password_form()
    {
        return view('front.auth.set_passworddds');
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
        $data = array('name'=>$name,'phone'=>$phone,'email'=>$email,'password'=>$request->password,'user_role'=>$request->user_role,'is_email_verified'=>1,'status'=>0);
        $check = $this->create($data);
        
        //dd($check);
        $user = User::where('email','=',$email)->update(['otp' => $otp]);

        $credentials = array('email'=>$email,'password'=>$request->password);
        //dd($credentials);
        $val = Auth::attempt($credentials);
        //dd($val);

        if(Auth::user()->user_role == 3)
        {
        $data = array('name'=>$name,'phone'=>$phone,'email'=>$email,'password'=>$request->password,'user_role'=>$request->user_role,'is_email_verified'=>1);
        Mail::to($email)->send(new sponsorcredentials($data));
        
        $sponsordata = Sponsor::create([

            'id' =>auth::id(),
            'sponsor_name' => $name,
            'sponsor_email' => $email,
            'sponsor_phone' => $phone,
            'sponsor_id'    =>  'IBS-'.rand(00000,99999),

        ]);
       // dd($data);
        return redirect("sponsorprofile");
        }
        else
        {
            $id = Auth::id();
            $vals = array('stu_id'=>$id,'college_id'=>'IBS-'.rand(00000,99999));
            $val = Profile::create($vals);
            return redirect("education/create-step-two");
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

    public function studentCourseInsert($cid)
    {
        $id = Auth::id();
        //$studentSelCid = $request->student_course_id;
        $status = Courseselection::where('stu_id', $id)->update(array('studentSelCid' => $cid));
       
        $studentcourse=Studentcourse::create([
            'stu_id'            => $id,
            'student_course_id' => $cid,
            'status'            =>1,
        ]);
        Session::flash('message', 'You will get the course offer soon!'); 
        Session::flash('alert-class', 'alert-success');
        //return redirect()->route('dashboard');   
        return redirect('userofferaccept');        
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
        
        DB::table('active_users')->where('user_id', '=', Auth::id())->delete();
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function approve_course()
    {
        $id = Auth::id();
        $status = Courseselection::where('stu_id', $id)->update(array('offer_accepted' => 1));
        //return redirect()->back(); 
        return redirect('useroffercongrats'); 
    }

    public function deny_course()
    {
        $id = Auth::id();
        $status = Courseselection::where('stu_id', $id)->update(array('offer_accepted' => 2,'offer_generated'=>0));
        //dd($status);
        return redirect()->back(); 
    }

    public function defer_course()
    {
        $id = Auth::id();
        $status = Courseselection::where('stu_id', $id)->update(array('offer_accepted' => 3,'offer_generated'=>0));
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

    public function user_profile()
    {
        $id = Auth::id();
        $existData['newval'] = Education::where('stu_id',$id)->get();
        
        //$existData['val'] = User::where('id',$id)->get();
        $existData['val'] = User::where('id',$id)->first();
        $existData['allval'] = Profile::where('stu_id',$id)->first();
        $name = $existData['val']->name;
        $space_count = substr_count($name, ' ');
        $fname = explode(' ',$name);
        //dd($space_count);
        $existData['val']['first_name'] = $fname[0];
        //dd($existData['val']['first_name']);
        if($space_count >= 1)
        {
            $existData['val']['mname'] = $fname[1];
        }
        if($space_count >= 2)
        {
            $existData['val']['lname'] = $fname[2];
        }
        
        return view('front.auth.profile',$existData);
    }

    public function update_profile(Request $request)
    {
        //dd($request->stu_id);
        $id = Auth::id();
        $val = $request->except('_token');
        //dd($val['stu_id']);
        $data = Profile::where('stu_id',$val['stu_id'])->get();
        
        //dd($lname);
        $c = count($data);
        if($c != 0)
        {
            //$val = array('');
            $val = Profile::where('stu_id',$val['stu_id'])->update($val);
            return redirect()->back(); 
            
        }
        else
        {
            $val = Profile::create($val);
            return redirect()->back(); 
        }
        //$id = Auth::id();        
        
    }

    public function error_page()
    {
        return view('front.unauthorized');
    }

    public function change_user()
    {
        $id = Auth::id();   
        $user = User::select('user_role')->where('id',$id)->get();
        
        //$existData['val'] = User::where('id',$id)->get();
        $existData['val'] = User::where('id',$id)->first();
        return view('front.auth.username_update',$existData,compact('user'));
    }

    public function change_pass()
    {
        return view('front.auth.update_password');
    }

    public function update_username(Request $request)
    {
        $val = $request->except('_token');
        $val = User::where('id',$val['id'])->update($val);
        return redirect()->back(); 
    }

    public function update_passwords(Request $request)
    {        
        $val = $request->except('_token');

        //dd($val);
        if($val['password'] === $val['confirm_password'])
        {  
            $vals = array('password'=>Hash::make($val['password']));          
            $valss = User::where('id',$val['id'])->update($vals);
            if($valss)
            {
                Session::flash('message', 'Password Updated Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('userprofile'); 
            }
        }
        else{
            Session::flash('message', 'password and confirm password does not match!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back(); 
            
        }        
    }

    public function sponsorlogin(){


        return view('front.auth.sponsorlogin');
    }

    public function sponsorprofile(){

        $sponsordata = Sponsor::all();

        return view('front.auth.sponsorprofile',compact('sponsordata'));
    }

    public function sponsorprofilepost(Request $request){

        if($request->hasFile('sponsor_image')){

            $sponsor_image = $request->sponsor_image->getClientOriginalname();
            $path = $request->sponsor_image->move(public_path('/image'),$sponsor_image);
        }

        

        $sponsordata= Sponsor::updateorcreate([

            'id' => auth::id(),
        ],[


            'title'            =>  $request->title,
            'middle_name'      =>  $request->middle_name,
            'last_name'        =>  $request->last_name,
            'position'         =>  $request->position,
            'alt_email'        =>  $request->alt_email,
            'province'         =>  $request->province,
            'address'          =>  $request->address,
            'main_phone_line'  =>  $request->main_phone_line,
            'alt_phone_line'   =>  $request->alt_phone_line,
            'company_name'     =>  $request->company_name,
            'alt_phone'        =>  $request->alt_phone,
            'sponsor_image'    =>  $sponsor_image


        ]);

        return redirect()->route('sponsorprofile')->with('success','Profile Updated !');
    }
}
