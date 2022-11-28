@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
       <link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
       <style>

        .parastyle{
            font-size:10px;
        }
        </style>
  <div class="background-register" style="margin-top:100px;"> 
 
        <div class="register-modal" style="width:100%;">
            <div class="register-logo">
                <a href="#"><img src="{{asset('assets/custom/New Project (14).png') }}" alt="" width="200px"></a>
            </div>  
            <div class="row d-flex justify-content-center align-items-center">
          
                <div class="col-md-9 col-lg-6 col-xl-5">

                <h5> iConnect | Sponsor Portal  </h5>
            
                        <p>
                        <h5> Welcome! </h5>​


<div class="parastyle"> 
<p> Please note the following instructions for a smooth Application to Admission into IBSUniversity.  </p>



<p> 1. Your submitted document will be assigned to an Enrolment Officer who will review your documents. If you have not received a response after 14 working days, an option will be made available for you to send your follow-up here on your iConnect Portal.</p>


<p> 2. Once the enrolment officer reviews your documents, they will make available to you the courses that you are eligible for​</p>



<p> 3. These courses that you are eligible for will be made available here, in your iConnect Portal for you to make your preferred selection that you wish to undertake at IBSUniversity </p>



<p> 4. Once you make your selection of the Course of your choice, you will immediately receive your offer​</p>



<p> 5. When you receive your offer, you can either Accept or Decline your offer. If you accept your offer, you will immediately receive your acceptance letter and sign; You will also receive your offer through email. If you decline, you will be asked to select a different Course of your choice again. </p>



<p> 6. After you receive your offer, you will then follow the next steps to obtain your invoice</p>



Feel free to reach out to our Admin on 74114100 or email ask@ibs.ac.pg if you need more clarity.
</p>
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="margin-bottom:100px;">

<h3>Login</h3>
            <form action="{{ route('login.post') }}" method="POST" class="register-form">
                @csrf
                
<div class="pull-right">
                    <label for="">Email Address</label>
                    <input type="email" placeholder="" name="email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif 
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" placeholder="" name="password" id="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="register-btn">
                    <button type="submit">Login</button>
                </div>
            
          </form>
</div>
</div>
        </div>
    </div>
    @include('front/footer')  
    @endsection   