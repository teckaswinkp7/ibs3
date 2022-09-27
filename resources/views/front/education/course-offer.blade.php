@extends('front.header')  
@section('content') 
<div class="site-section">
<div class="container">
<div class="row justify-content-center"> 
@include('front.leftsidebar')   
<div class="col-md-9">
<div class="card custom-margin"> 
  
  <div class="row">
    <h5>Course Offer Details</h5>
    
    <div class="col-md-12">
      

        {{-- <p>{{$student_course_offer[0]->course_offer_description}}</p> --}}
        @if(count($student_course_offer) >=1)
        <div class="row">
          <div class="col-sm-3">
          <div class="form-group">
            <h4 class="mb-2 ml-3 profile-name">Course Name</h4>
          </div>
          </div>
          <div class="col-sm-9">
            <div class="form-group">
              <input type="text" value="{{$student_course_offer[0]->courses_name}}" name="stu_id" class="form-control"  readonly>
            </div>
          </div>
        </div>
        <input type="hidden" value="{{$student_course_offer[0]->stu_id}}" name="stu_id" class="form-control"  readonly>
        <input type="hidden" value="{{$student_course_offer[0]->student_course_id}}" name="student_course_id" class="form-control"  readonly>
        
        @if($student_course_offer[0]->offer_accepted == 0)
        
        <a href="courseApproved"><button type="submit" class="btn btn-success">Approve</button></a>
        
        <a href="courseDenied"><button type="submit" class="btn btn-danger">Decline</button></a>
        @endif
        <div class="row">
          <div class="col-sm-3">
          <div class="form-group">
            <h4 class="mb-2 ml-3 profile-name">Course Status</h4>
          </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              @if($student_course_offer[0]->offer_accepted == 1)
              <h4 class="mb-2 ml-3 profile-name">Approved <i style="color:#51be78;" class="fa fa-check-circle"></i></h4>
              @elseif($student_course_offer[0]->offer_accepted == 2)
              <h4 class="mb-2 ml-3 profile-name">Not Approved <i style="color:red;" class="fa fa-times"></i></h4>
              @else
              <h4 class="mb-2 ml-3 profile-name">Awaiting <i style="color:orange;" class="fa fa-clock"></i></h4>
              @endif
            </div>
          </div>
        </div>
        
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>        
        @endif        
        
        
        @if($student_course_offer[0]->invoice_sent == 1)
        <div class="accordion custom-margin" id="payment_process">    
        {{-- <h4 class="mb-2 ml-3 profile-name"> You must have received an invoice in your email to enroll in this course</h4> --}}
        
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Course</th>
          <th>Price</th>
          <th>Invoice</th> 
          @if($student_course_offer[0]->receipt != null || $student_course_offer[0]->receipt != '')
          <th>Receipt</th> 
          @endif      
          </tr>
          </thead>
          <tbody>       
          <tr>        
          <td>{{ $student_course_offer[0]->courses_name }}</td>       
          <td>${{ $student_course_offer[0]->price }}</td>
          <td><a href="{{Url('public/uploads/attachment')}}/{{ $student_course_offer[0]->invoice }}" target="_blank"><img src="{{Url('public/uploads/')}}/pdf_icon.png" style="width:40px;height:50px;"></a></td>      
          @if($student_course_offer[0]->receipt != null || $student_course_offer[0]->receipt != '')
          <td><a href="{{Url('public/uploads/receipt')}}/{{ $student_course_offer[0]->receipt }}" target="_blank"><img src="{{Url('public/uploads/')}}/pdf_icon.png" style="width:40px;height:50px;"></a></td>
          @endif
          </tr>
          </tbody>
        </table> 

        @if(!empty($sponsorData))
        <h4 class="mb-2 ml-3 profile-name">Requsted Sponsor</h4>
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Sponsor</th>
          <th>Email</th>
          <th>Phone</th> 
              
          </tr>
          </thead>
          <tbody>       
          <tr>        
          <td>{{ $sponsorData->sponsor_name }}</td>       
          <td>{{ $sponsorData->sponsor_email }}</td>
          <td>{{ $sponsorData->sponsor_phone }}</td>      
          
          </tr>
          </tbody>
        </table> 
        @else
        @if($student_course_offer[0]->receipt == null)

        <select class="form-control" name="payment_method" id="payment_method" onchange="checkPayOptions()">
        <option value="">I Want to pay</option>
        <option value="Online">Online Transfer</option>
        <option value="Bank Transfer">Direct Deposit</option>
        <option value="Mobile Banking">Mobile Banking</option>
        <option value="Visa Transfer">Visa Transfer</option>        
        <option value="Sponsor">Sponsor</option>
        </select>
        <h4 class="mb-2 ml-3 profile-name" style="display:none;" id="amt">Amount : ${{$student_course_offer[0]->price}}</h4>
        <a href="#"><button style="margin-top:20px; display:none;" id="paynow" type="submit" class="btn btn-success">Pay Now</button></a>
        </div>

        <div class="accordion custom-margin" id="sponsor" style="display:none;">    
        

        {{-- <div class="row">
          <div class="col-sm-4">
            <div class="form-group"> 
              <input type="email" class="form-control" name="sponsor_email_search" id="sponsor_email_search" placeholder="Search By Sponsor Email">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group"> 
              <button class="btn btn-success"  onclick="searchSponsor()">Search</button>
            </div>
          </div>
        </div> --}}
        <h4 class="mb-2 ml-3 profile-name"> Fill the sponsor details</h4>
        <form action="{{ route('education.sponsor') }}" method="post" class="mb-0">
        @csrf  
          
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">  
            <input type="hidden" class="form-control" name="course_id" value="{{$student_course_offer[0]->student_course_id}}">
            <input type="text" class="form-control" name="sponsor_name" placeholder="Sponsor/Company Name">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group"> 
              <input type="text" class="form-control" name="sponsor_phone" placeholder="Sponsor Phone">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group"> 
              <input type="email" class="form-control" name="sponsor_email" placeholder="Sponsor Email">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        </form>
        </div>

        <!-- <select class="form-control" name="payment_method" id="payment_method" onchange="checkPayOptions()">
        <option value="">I Want to pay</option>
        <option value="Online">Online</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="Sponsor">Sponsor</option>
        </select> -->
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
        @endif
        @endif
        @else
        No Course Offered Yet.
        @endif
        
      </div> 
     
  </div> 
</div>
</div>
</div>
</div>
</div>
</div>


@include('front.footer')  
{{-- <script src="http://localhost/ibs/assets/front/js/jquery-3.3.1.min.js"></script> --}}
<script>
  function searchSponsor()
  {
    alert('ok');
    //return;
    var email = $('#sponsor_email_search').val();
    alert(email);
    $.ajax({
      
      url: "{{route('searchSponsor')}}",
      method: 'post',
      data:{email : email},
       success: function(result){
        console.log(result);
        
      },
      error: function (errorMessage) {
        alert('Error' + errorMessage);
    }
  });
  }
</script>
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
      $('#sponsor').hide();
    }
    else if(pay_method == 'Bank Transfer')
    {
      $('#bank').show();
      $('#paynow').hide();
      $('#amt').hide();
      $('#sponsor').hide();
    }
    else if(pay_method == 'Sponsor')
    {
      $('#sponsor').show();
      $('#bank').hide();
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
</script>



</body>

</html>   