@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
<div class="row justify-content-center"> 
@include('front/leftsidebar')   
<div class="col-md-9">
<div class="card custom-margin"> 
  
  <div class="row">
    <h5>Course Offer Details</h5>
    
    <div class="col-md-12">
        
        <p>{{$student_course_offer[0]->course_offer_description}}</p>
        <input type="text" value="{{$student_course_offer[0]->courses_name}}" name="stu_id" class="form-control"  readonly>
        <input type="hidden" value="{{$student_course_offer[0]->stu_id}}" name="stu_id" class="form-control"  readonly>
        <input type="hidden" value="{{$student_course_offer[0]->student_course_id}}" name="student_course_id" class="form-control"  readonly>
        @if($student_course_offer[0]->offer_accepted == 0 || $student_course_offer[0]->offer_accepted == 2)
        
        <a href="courseApproved"><button type="submit" class="btn btn-success">Approve</button></a>
        
        <a href="courseDenied"><button type="submit" class="btn btn-danger">Decline</button></a>
        @endif
        @if($student_course_offer[0]->offer_accepted == 1)
        <h4 class="mb-2 ml-3 profile-name">Approved <i style="color:#51be78;" class="fa fa-check-circle"></i></h4>
        @else
        <h4 class="mb-2 ml-3 profile-name">Not Approved <i style="color:red;" class="fa fa-times"></i></h4>
        @endif
        
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        
        @if($student_course_offer[0]->invoice_sent == 1)
        <div class="accordion custom-margin" id="payment_process">    
        <h4 class="mb-2 ml-3 profile-name"> You must have received an invoice in your email to enroll in this course</h4>
        <select class="form-control" name="payment_method" id="payment_method" onchange="checkPayOptions()">
        <option value="">I Want to pay</option>
        <option value="Online">Online</option>
        <option value="Bank Transfer">Bank Transfer</option>
        </select>
        <h4 class="mb-2 ml-3 profile-name" style="display:none;" id="amt">Amount : ${{$student_course_offer[0]->price}}</h4>
        <a href="#"><button style="margin-top:20px; display:none;" id="paynow" type="submit" class="btn btn-success">Pay Now</button></a>
        </div>

        <div class="accordion custom-margin" id="bank" style="display:none;">      
          <h4 class="mb-2 ml-3 profile-name">Amount : ${{$student_course_offer[0]->price}}</h4>
          <h4 class="mb-2 ml-3 profile-name">Bank Name : {{$bankdetails->bank_name}}</h4>
          <h4 class="mb-2 ml-3 profile-name">IFSC Code : {{$bankdetails->ifsc_code}}</h4>
          <h4 class="mb-2 ml-3 profile-name">Account Number : <span>{{$bankdetails->account_number}}</span></h4>
          <h4 class="mb-2 ml-3 profile-name">Account Holder : {{$bankdetails->account_holder_name}}</h4>

          <p style="color:#51be78;font-weight:bold;">Please upload your reciept after successful payment</p>
          
          <form action="{{ route('education.receipt') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
          @csrf
          <input type="file" class="form-control" name="receipt">
          <button type="submit" style="margin-top:20px;" class="btn btn-success">Upload Receipt</button>
          </form>
        </div>
        @endif

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
<script>
  function checkPayOptions()
  {
    var pay_method = $('#payment_method').val();    
    if(pay_method == 'Online')
    {
      $('#bank').hide();
      $('#paynow').show();
      $('#amt').show();
    }
    else if(pay_method == 'Bank Transfer')
    {
      $('#bank').show();
      $('#paynow').hide();
      $('#amt').hide();
    }
  }
</script>

</body>
</html>   