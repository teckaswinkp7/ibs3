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
        <p>Approved</p>
        @else
        <p>Not Approved</p>
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
</body>
</html>   