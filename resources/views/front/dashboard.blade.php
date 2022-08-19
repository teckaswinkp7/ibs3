@extends('front/header')  
@section('content') 
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center"> 
    @include('front/leftsidebar')   
		<div class="col-md-9">
		    <div class="card custom-margin">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form>
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">Name*</label> 
                                <div class="col-8">
                                 <p>Himanshu Kumar</p>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Email*</label> 
                                <div class="col-8">
                                  <p>himanshukumar@virtualemployee.com</p>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="newpass" class="col-4 col-form-label">Phone</label> 
                                <div class="col-8">
                                  <p>9304781861</p>
                                </div>
                              </div> 
                            </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
  </div>
</div>
@include('front/footer')  
@endsection
</body>
</html>   