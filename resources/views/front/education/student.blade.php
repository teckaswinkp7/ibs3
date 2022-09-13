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
          </tr>
          </thead>
          <tbody> 
          
          @foreach ($student_course_offer as $value)
          <tr>
          <td>{{ $value->name }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->courses_name }}</td>
          <td>${{ $value->price }}</td>
          </tr>
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
</body>
</html>   