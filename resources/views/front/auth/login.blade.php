@extends('front/header')  
@section('content') 

@if (Auth::check() && Auth::id() != 2)
  <script>
    window.location = "{{ route('update-profile') }}";
  </script>
@endif

<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image:url({{asset('assets/front/images/bg_1.jpg')}});">
  <div class="container">
    <div class="row align-items-end justify-content-center text-center">
      <div class="col-lg-7">
        <h2 class="mb-0">Login</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
      </div>
    </div>
  </div>
</div> 
<div class="custom-breadcrumns border-bottom">
  <div class="container">
    <a href="{{ URL::to('/') }}">Home</a>
    <i class="mx-3 mt-2 fa-solid fa-angle-right" style="font-size:12px;"></i>
    <span class="current">Login</span>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <form action="{{ route('login.post') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="email">Email Address</label>
              <input type="text" id="email_address" class="form-control form-control-lg" name="email" placeholder="Email" required autofocus>
              @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif   
            </div>
            <div class="col-md-12 form-group">
              <label for="password">Password</label>
              <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
              @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember"> 
                <label for="remember">Remember Me</label>
              </div>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary btn-lg px-5">Login</button>
            </div>
          </div>
        </form>
        <p class="mb-0">
          <a href="{{ route('registers') }}" class="text-center">Register a new account</a>
        </p>
      </div>
    </div>  
  </div>
</div>
@include('front/footer')  
@endsection   