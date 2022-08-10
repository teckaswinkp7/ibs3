
@extends('front/header')  
@section('content')
<div class="register-box">
  <div class="card">
    <div class="login-box-msg mt-3">Register</div>
    <div class="card-body register-card-body">
      <form action="{{ route('register.post') }}" method="POST">
      @csrf
      <div class="input-group mb-3">
        <input type="text" id="id" class="form-control" name="uid" placeholder="ID" required autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>
      @if ($errors->has('uid'))
       <div class="input-group mb-3"> <span class="text-danger">{{ $errors->first('uid') }}</span></div>
      @endif
      <div class="input-group mb-3">
        <input type="text" id="email_address" class="form-control" name="email" placeholder="Email" required autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      @if ($errors->has('email'))
       <div class="input-group mb-3"> <span class="text-danger">{{ $errors->first('email') }}</span></div>
      @endif
      <div class="input-group mb-3">
        <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      @if ($errors->has('password'))
       <div class="input-group mb-3"> <span class="text-danger">{{ $errors->first('password') }}</span></div>
      @endif
      <div class="row">
        <div class="col-md-8">
          <div class="checkbox">
            <label>
            <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary">
          Register
          </button>
        </div>
      </div>
      </form>
      <p class="mb-0">
        <a href="{{ route('login') }}" class="text-center">Already Regsitered</a>
      </p>
    </div>
  </div>
</div>
@include('front/footer')  
@endsection  