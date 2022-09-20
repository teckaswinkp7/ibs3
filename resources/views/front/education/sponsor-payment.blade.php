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
      <h4>{{$sponsorDetails->course_name }}</h4>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">      
        <div id="payment_process">    
        <h4 class="mb-2 ml-3 profile-name"> Pay for <span style="color:#51be78;">{{ $sponsorDetails->student_name}}</span></h4>
        <select class="form-control" name="payment_method" id="payment_method" onchange="checkPayOptions()">
        <option value="">I Want to pay</option>
        <option value="Online">Online Transfer</option>
        <option value="Bank Transfer">Direct Deposit</option>
        <option value="Mobile Banking">Mobile Banking</option>
        <option value="Visa Transfer">Visa Transfer</option>        
        </select>
        <div style="display:none;" id="amt">         
        <h4 class="mb-2 ml-3 profile-name">Amount : ${{$sponsorDetails->price}}</h4>
        </div>
        <a href="#"><button style="margin-top:20px; display:none;" id="paynow" type="submit" class="btn btn-success">Pay Now</button></a>
        </div>

        <div class="accordion custom-margin" id="bank" style="display:none;"> 
          <div class="accordion custom-margin">  
        
        </div>

          <h4 class="mb-2 ml-3 profile-name">Amount : ${{$sponsorDetails->price}}</h4>
          <h4 class="mb-2 ml-3 profile-name">Bank Name : {{$bankdetails->bank_name}}</h4>
          <h4 class="mb-2 ml-3 profile-name">IFSC Code : {{$bankdetails->ifsc_code}}</h4>
          <h4 class="mb-2 ml-3 profile-name">Account Number : <span>{{$bankdetails->account_number}}</span></h4>
          <h4 class="mb-2 ml-3 profile-name">Account Holder : {{$bankdetails->account_holder_name}}</h4>

          <p style="color:#51be78;font-weight:bold;">Please upload your reciept after successful payment</p>
          
          <form action="{{ route('education.sponsor.receipt') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
          @csrf
          <input type="hidden" class="form-control" name="stu_id" value="{{ $sponsorDetails->stu_id }}">
          <input type="file" class="form-control" name="receipt">
          <button type="submit" style="margin-top:20px;" class="btn btn-success">Upload Receipt</button>
          </form>
        </div>
       

    </div>
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
    else
    {
      $('#bank').hide();
      $('#paynow').show();
      $('#amt').show();    
    }
  }

  function check_price()
  {
    var stu_id = $('#sutdent_id').val();
    
  }
</script>
</body>
</html>   