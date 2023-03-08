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
            <h3>Login</h3>
            <form action="{{ route('reset.password.post') }}" method="POST">

@csrf

<input type="hidden" name="token" value="{{ $token }}">



<div class="form-group row">

    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

    <div class="col-md-6">

        <input type="text" id="email_address" class="form-control" name="email" required autofocus>

        @if ($errors->has('email'))

            <span class="text-danger">{{ $errors->first('email') }}</span>

        @endif

    </div>

</div>



<div class="form-group row">

    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

    <div class="col-md-6">

        <input type="password" id="password" class="form-control" name="password" required autofocus>

        @if ($errors->has('password'))

            <span class="text-danger">{{ $errors->first('password') }}</span>

        @endif

    </div>

</div>



<div class="form-group row">

    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

    <div class="col-md-6">

        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>

        @if ($errors->has('password_confirmation'))

            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

        @endif

    </div>

</div>



<div class="col-md-6 offset-md-4 register-btn">

    <button type="submit" class="btn btn-primary">

        Reset Password

    </button>

</div>

</form>
        </div>
    </div>
    @include('front/footer')  
    @endsection   