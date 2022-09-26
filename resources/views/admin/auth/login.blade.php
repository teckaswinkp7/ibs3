@extends('admin.layoutlogin')
@section('content')
<div class="login-box">
  <div class="card card-outline card-primary">
                  <div class="card-header text-center"> 
                    <img src="{{asset('assets/admin/img/IBS-Logo.png')}}">
                  </div>
                  <div class="card-body">
                  <p class="login-box-msg">Sign in to start your session</p>
                  @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>        
                  @endif
                      <form action="{{ route('admin/login.post') }}" method="POST">
                          @csrf
                          <div class="input-group mb-3">
                            <input type="text" id="email_address" class="form-control" name="email" placeholder="Email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>    
                          </div>
  
                          <div class="input-group mb-3">
                              <div class="input-group mb-3">
                                  <input type="password" id="password" class="form-control" name="password" 
                                  placeholder="Password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                                          <div class="input-group-append">
                                          <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                          </div>
                                </div>
                              </div>
                          </div>
  
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="icheck-primary">
                                          <input type="checkbox" name="remember" id="remember"> 
                                          <label for="remember">Remember Me
                                          </label>
                                  </div>
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4 mt-4">
                              <button type="submit" class="btn btn-primary">
                                  Login
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          
</div>
@endsection