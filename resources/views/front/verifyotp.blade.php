@extends('front/header')  
@section('content') 
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image:url({{asset('assets/front/images/bg_1.jpg')}});">
  <div class="container">
    <div class="row align-items-end justify-content-center text-center">
      <div class="col-lg-7">
        <h2 class="mb-0">Otp Validation</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
      </div>
    </div>
  </div>
</div> 
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <form action="{{route('validateOtp')}}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="email">OTP Validation</label>
              <input type="text" id="otp" class="form-control form-control-lg" name="otp" placeholder="OTP" required autofocus> 
            </div>
          </div>
          <div>Expire In <span id="timer"></span></div>
            {!! csrf_field() !!}
            <input id="email" name="email" type="hidden" value="{{$email}}">
          <div class="row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary btn-lg px-5">Submit</button>
            </div>
          </div>
        </form>
        <form class="needs-validation" action="{{route('resendOtp')}}" method="post" novalidate>
            {!! csrf_field() !!}
            <div class="row" style="margin-top:16px;">
            <div class="col-md-4">
            <input id="email" name="email" type="hidden" value="{{$email}}">
            <button class="btn btn-success" type="submit">Resend OTP</button>
            </div>
            </div>
        </form>
      </div>
    </div>  
  </div>
</div>
@include('front/footer')  
@endsection  