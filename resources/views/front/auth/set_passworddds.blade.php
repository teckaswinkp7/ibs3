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
            <form action="{{route('register.final')}}" method="POST" class="register-form">
                @csrf
               
                    
                    <input type="hidden" id="user_role" name="user_role" value="2">
                        
                <div>
                    <label for="">Password</label>
                    <input type="password" placeholder="" name="password" >
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div>
                    <label for="">Confirm Password</label>
                    <input type="password" placeholder="" name="confirm_password" >
                    @if ($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
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