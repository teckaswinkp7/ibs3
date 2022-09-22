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
      <h4>Sponsered Student</h4>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form>
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>        
        @endif
        @if(Auth::user()->user_role == 3) 
        
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Sl.No</th>
          <th>Student Name</th>
          <th>Email</th>
          <th>Course</th>
          <th>Price</th>          
          <th>Action</th>
          </tr>
          </thead>
          <tbody> 
          <?php  $i=1; ?>
          @foreach ($sponsorDetails as $value)
          <tr>
          <td>{{ $i }}</td>
          <td>{{ $value->student_name }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->course_name }}</td>
          <td>${{ $value->price }}</td>
          
          @if($value->receipt == null || $value->receipt == '')
          <td><a href="{{route('sponsor.pay',$value->stu_id) }}" class="btn btn-warning">Pay Now</a></td>             
          @else
          <td><label class="btn btn-success">Amt Paid</label></td> 
          @endif
        </tr>
          <?php $i++; $s_total = $i; ?>
          @endforeach
          </tbody>
        </table>
        @endif
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

  function check_price()
  {
    var stu_id = $('#sutdent_id').val();
    
  }
</script>
</body>
</html>   