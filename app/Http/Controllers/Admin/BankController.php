<?php

namespace App\Http\Controllers\Admin;
use App\Models\Bankdetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;


class BankController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['bankDetails'] = Bankdetails::orderBy('id','desc')->get();
   // dd($data['bankDetails']);
    return view('admin\bank.index', $data);
    //return view('categories.index', compact('categories'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {        
        return view('admin\bank.create');
        
        //return view('categories.create');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
         $request->validate([
        'ifsc_code'             => 'required',
        'bank_name'             => 'required',
        'account_number'        =>'required',
        'account_holder_name'   => 'required'        
        ]);

        
        Bankdetails::create([
            'ifsc_code'             => $request->ifsc_code,
            'bank_name'             => $request->bank_name,
            'account_number'        => $request->account_number,
            'account_holder_name'   => $request->account_holder_name,            
        ]);
        
        return redirect()->route('screening.index')
        ->with('success','created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $bankdetails = Bankdetails::findOrFail($id);    
        
        return view('admin\bank.edit', compact('bankdetails'));
    }
           
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id)
    {
    
    // $request->validate([
    //     'ifsc_code'             => $request->ifsc_code,
    //     'bank_name'             => $request->bank_name,
    //     'account_number'        => $request->account_number,
    //     'account_holder_name'   => $request->account_holder_name, 
    // ]);

    $bankData = Bankdetails::findOrFail($id);
    if($request->ifsc_code != $request->bank_name || $request->account_number != $request->account_holder_name)
    {
        $data = array(
        'ifsc_code'             => $request->ifsc_code,
        'bank_name'             => $request->bank_name,
        'account_number'        => $request->account_number,
        'account_holder_name'   => $request->account_holder_name
        );
        Bankdetails::where('id', $id)->update($data);
        return redirect()->route('bank.index')
        ->with('success','Bank Details Updated Successfully');   
    }  
    else
    {
        return redirect()->route('bank.index')
        ->with('danger','Error during update'); 
    }
    
    }
    
    
}
