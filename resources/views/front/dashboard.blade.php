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
        @if(Auth::user()->user_role == 2) 
        <h5>Educational Details</h5>
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Qualification</th>
          <th>Board</th>
          <th>Percentage</th>
          <th>Staus</th>
          <th>Action</th>
          </tr>
          </thead>
          <tbody> 
          @php
            $student_education = DB::select( DB::raw("SELECT e.*,d.status FROM education e join documents d on d.stu_id=e.stu_id WHERE e.stu_id = '".Auth::user()->id."'"));
          @endphp
          @foreach ($student_education as $cat)
          <tr>
          <td>{{ $cat->qualification }}</td>
          <td>{{ $cat->board }}</td>
          <td>{{ $cat->percentage }}</td>
          <td>{{ ($cat->status == 1) ? 'Verified' : 'Verification Failed' }}</td>
          @if($cat->status == 1)
          
            <td><i class="fa fa-check-circle" style="color: green;"></i></td>
          
          @else
          
            <td>
              <a href="{{ route('education.create.step.two')}}">Reupload</a>
            </td>
          
          @endif
          
          </tr>
          @endforeach
          </tbody>
        </table>
        @endif
      </form>
    </div>
  </div>

  @if(Auth::user()->user_role == 2) 
  <div class="row">
    <h5>Course Details</h5>
    <div class="col-md-12">
      <form action="{{ route('student.course') }}" method="POST">
       @csrf  
        <input type="hidden" value="{{ Auth::user()->id }}" name="stu_id" class="form-control">
        <div class="form-group row">
          <label for="username" class="col-4 col-form-label">Name*</label> 
          <div class="col-8">
            <select name="student_course_id" id="student_course_id" class="form-control" required>
              <option value="">--Select---</option>
              @php
                $course_list = DB::select( DB::raw("SELECT * FROM courseselections WHERE stu_id = '".Auth::user()->id."'"));
              @endphp

              @if(!empty($course_list))
                @foreach($course_list as $cl)
                  @php 
                    $course_id = $cl->course_id;
                    $studentSelCid = $cl->studentSelCid;
                    $course_id = str_replace("[","",$course_id);
                    $course_id = str_replace("]","",$course_id);
                    $course_id = str_replace('"','',$course_id);
                    $course_id_arr = explode(",",$course_id);
                  @endphp
                @endforeach
                @foreach ($course_id_arr as $key => $val)
                @php
                $course_name = DB::select(DB::raw("SELECT * FROM courses WHERE id = $val"));
                
                @endphp
                  <option value="{{ $val }}" {{ $studentSelCid == $val? 'selected="selected"' : "" }}>{{ $val }}</option>
                @endforeach
              @else
                @php
                  $studentSelCid = 0;
                @endphp
              @endif
            </select>
          </div>
        </div>

        @if($studentSelCid == 0)
          <button type="submit" class="btn btn-primary">Submit</button>
        @endif
      
      </form>  
</div>
@endif
@php /*
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
  */ @endphp  
  </div> 
  
  <div class="row">
  @php /*
    <h5>Course Offer Details</h5>
    
    <div class="col-md-12">
        <p>{{$student_course_offer[0]->course_offer_description}}</p>
        <input type="hidden" value="{{$student_course_offer[0]->stu_id}}" name="stu_id" class="form-control"  readonly>
        <input type="hidden" value="{{$student_course_offer[0]->offer_course_id}}" name="student_course_id" class="form-control"  readonly>
        @if(empty($student_course_offer[0]->status))
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
    */ @endphp 
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