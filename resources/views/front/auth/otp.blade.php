@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
    <div class="background-otp" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="./New Project (14).png" alt="" width="120px"></a>
            </div>  
            <h3>Confirm your email</h3>
            <p>You should receive an email containing your code/one-time password (OTP) to verify your email. Kindly copy and paste code here to confirm</p>
            <p>Time: <span id="timer"></span> 5 minutes</p>
            <form action="{{route('validateOtp')}}" method="POST" class="register-form">
                @csrf
                <div>
                    <label for="">Code</label>
                    <input type="text" placeholder="" id="otp" name="otp">
                </div>
                <div class="otp-btn">
                    <button type="submit">Confirm</button>
                </div>
                <p>Didn't recieve the code?</p>
                <a href="#">Resend code</a>
          </form>

          
        </div>
    </div>
@include('front/footer')  
@endsection   