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
        <h5>Personal Details</h5>
        <div class="form-group row">
          <label for="username" class="col-4 col-form-label">Name*</label> 
          <div class="col-8">
          <p>{{ ucwords(Auth::user()->name) }}</p>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-4 col-form-label">Email*</label> 
          <div class="col-8">
          <p>{{ Auth::user()->email}}</p>
          </div>
        </div>
        <div class="form-group row">
          <label for="newpass" class="col-4 col-form-label">Phone</label> 
          <div class="col-8">
          <p>{{ Auth::user()->phone }}</p>
          </div>
        </div> 
        <h5>Educational Details</h5>
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Qualification</th>
          <th>Board</th>
          <th>Percentage</th>
          </tr>
          </thead>
          <tbody> 
          @foreach ($student_edu as $cat)
          <tr>
          <td>{{ $cat->qualification }}</td>
          <td>{{ $cat->board }}</td>
          <td>{{ $cat->percentage }}</td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </form>
    </div>
  </div>
  <div class="row">
    <h5>Course Details</h5>
    <div class="col-md-12">
      <form action="{{ route('student.course') }}" method="POST">
       @csrf  
        <input type="hidden" value="{{ Auth::user()->id }}" name="stu_id" class="form-control">
        <div class="form-group row">
          <label for="username" class="col-4 col-form-label">Name*</label> 
          <div class="col-8">
            <select name="student_course_id" id="student_course_id" class="form-control" @if($studentcourse[0]->status == 1) disabled @endif>
              @foreach ($course_final_select as $key => $cselect)
              @if($studentcourse[0]->status == 1)
              <option value="{{$course_sel[$key]}}" @if($studentcourse[0]->student_course_id == $course_sel[$key] )  selected  @endif>{{$cselect[0]}}</option>
              @else
              <option value="{{$course_sel[$key]}}">{{$cselect[0]}}</option>
              @endif  
              @endforeach
            </select>
          </div>
        </div>
        @if($studentcourse[0]->status == 1)
        <button type="submit" class="btn btn-primary" style="display:none">Submit</button>
        @else
        <button type="submit" class="btn btn-primary">Submit</button>
        @endif
      </form>  
</div>
@if($studentcourse[0]->status == 1)
    <div class="col-md-12" style="display:none;">
      <form action="{{ route('student.course') }}" method="POST">
       @csrf  
        <input type="hidden" value="{{ Auth::user()->id }}" name="stu_id" class="form-control">
        <div class="form-group row">
          <label for="username" class="col-4 col-form-label">Name*</label> 
          <div class="col-8">
            <select name="student_course_id" id="student_course_id" class="form-control">
              @foreach ($course_final_select as $key => $cselect)
              <option value="{{$course_sel[$key]}}">{{$cselect[0]}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>  
    
    </div>  
  @endif  
  </div> 
  
  <div class="row">
    <h5>Course Offer Details</h5>
    <div class="col-md-12">
        <p>{{$student_course_offer[0]->course_offer_description}}</p>
        <input type="hidden" value="{{$student_course_offer[0]->stu_id}}" name="stu_id" class="form-control"  readonly>
        <input type="hidden" value="{{$student_course_offer[0]->offer_course_id}}" name="student_course_id" class="form-control"  readonly>
        @if($student_course_offer[0]->status == "NULL")
        <form action="{{route('approve', $student_course_offer[0]->id)}}" method="POST">
        @csrf  
        <button type="submit" class="btn btn-success">Approve</button>
        </form>
        <form action="{{route('decline', $student_course_offer[0]->id)}}" method="POST">
        @csrf  
        <button type="submit" class="btn btn-danger">Decline</button>
        </form>
        @elseif($student_course_offer[0]->status == 1)
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