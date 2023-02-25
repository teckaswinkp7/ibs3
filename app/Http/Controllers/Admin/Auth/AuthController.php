<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Role;
use Hash;
use DB;
class AuthController extends Controller
{
    //
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('admin.auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        $role=Role::all();
        return view('admin.auth.registration')->with('role',$role);
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
        $userVal = User::where('email',$request->email)->first();
       
        //dd($userVal);
        if(!empty($userVal))
        {
            if($userVal->user_role == 1)
            //$role = Auth::user_role();
            {
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {

                   
                    
                    return redirect()->intended('admin\dashboard')
                                ->withSuccess('You have Successfully loggedin');
                }
                Session::flash('message', 'Opps! Invalid credentials'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect("admin\login");
            }

            else
            {
                Session::flash('message', 'You are not authorized!'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('admin\login');            
            } 
        }
        else
        {
            Session::flash('message', 'User does not exist!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin\login');  
        }
        
       
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'uid' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("admin/dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('admin.dashboard');
            // if(Auth::id() == 2)
            // {
            //     return view('admin.dashboard');
            // }
            // else
            // {
            //     return redirect('unauthorized');
            // }
        }
  
        return redirect("admin\login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'uid' => $data['uid'],
        'user_role' => '3',
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
        
        return Redirect('admin\login');
    }
}
