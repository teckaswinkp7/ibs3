@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
    
<div class="background-register" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="{{asset('assets/custom/New Project (14).png') }}" alt="" width="120px"></a>
            </div>  
            <h3>Create your account</h3>
            <form action="{{ route('register.post') }}" method="POST" class="register-form">
                @csrf
                <div>
                    <label for="">Full Name</label>
                    <input type="text" placeholder="" name="name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div>
                    <label for="">Email Address</label>
                    <input type="email" placeholder="" name="email" >
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="text" placeholder="" name="phone" >
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="register-btn">
                    <button type="submit">Register</button>
                </div>
            
          </form>
        </div>
    </div>
    @include('front/footer')  
    @endsection   