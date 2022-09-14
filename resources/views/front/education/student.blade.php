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
      <h4>Student Data</h4>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form>
        
        @if(Auth::user()->user_role == 3) 
        <h5>Needs Sponser</h5>
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Student Name</th>
          <th>Email</th>
          <th>Course</th>
          <th>Price</th>
          <th>Invoice</th>
          </tr>
          </thead>
          <tbody> 
          
          @foreach ($student_course_offer as $value)
          <tr>
          <td>{{ $value->name }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->courses_name }}</td>
          <td>${{ $value->price }}</td>
          <td><a href="{{Url('public/uploads/attachment')}}/{{ $value->invoice }}" target="_blank"><img src="{{Url('public/uploads/attachment')}}/{{ $value->invoice }}" style="width:100px;height:100px;"></a></td>
          </tr>
          @endforeach
          </tbody>
        </table>
        @endif
      </form>

      @if($student_course_offer[0]->invoice_sent == 1)
        <div class="accordion custom-margin" id="payment_process">    
        <h4 class="mb-2 ml-3 profile-name"> You must have received an invoice in your email to enroll in this course</h4>
        <select class="form-control" name="payment_method" id="payment_method" onchange="checkPayOptions()">
        <option value="">I Want to pay</option>
        <option value="Online">Online</option>
        <option value="Bank Transfer">Bank Transfer</option>
        </select>
        <div style="display:none;" id="amt"> 
        <h4 class="mb-2 ml-3 profile-name"> Select Student</h4>
        <select class="form-control" name="payment_method" id="sutdent_id" onchange="checkPayOptions()">
        @foreach ($student_course_offer as $value)
        <option value="{{$value->stu_id}}">{{$value->name}}</option>
        @endforeach        
        </select>
        <h4 class="mb-2 ml-3 profile-name">Amount : ${{$student_course_offer[0]->price}}</h4>
        </div>
        <a href="#"><button style="margin-top:20px; display:none;" id="paynow" type="submit" class="btn btn-success">Pay Now</button></a>
        </div>

        <div class="accordion custom-margin" id="bank" style="display:none;"> 
        <div class="accordion custom-margin">    
        <h4 class="mb-2 ml-3 profile-name"> Select Student</h4>        
        <select class="form-control" name="payment_method" id="sutdent_id" onchange="checkPayOptions()">
        @foreach ($student_course_offer as $value)
        <option value="{{$value->stu_id}}">{{$value->name}}</option>
        @endforeach        
        </select>
        </div>

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