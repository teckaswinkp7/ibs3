<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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
        //dd($request->file('document'));
        for ($i = 0; $i < $size; $i++)
            {
                //
                $education = new Education;
                $id = Auth::id();
                $education->stu_id =$id ;
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
                return redirect()->route('dashboard');    
            }
            /*$file= $request->file('document');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $edu->document = $filename;*/
            //return response()->json(['success'=>'Added new records.']);
         
  
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
    
}
