@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                
              </div>
              <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <form action="{{route('search.index')}}">
            <input type="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>
</form>  
          </ol>
              </div>
            </div>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid" >
            <!-- SELECT2 EXAMPLE -->
            <div class="row">
                <h3 class="card-title">Application Review Panel</h3>
                
</div>
               <!-- /.card-header -->
              
                
              
                
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif

                    
 <div class="row myrow">
                          <div class="col-md-4">
                          <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control"  readonly>
                                <input type="hidden" value="{{ $user->id }}" name="stu_id" class="form-control"  readonly>
                              </div>
                             
                           
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ $user->email }}" name="email" class="form-control"  readonly>
                              </div>
                            
                            
                              <div class="form-group">
                                <label>Highest Qualification</label>
                                <input type="text" value="{{$users[0]->board}}" name="phone" class="form-control"  readonly>
                              </div>
<br>
<br>

<div class="card">
  <div class="card-body cardcolor">
  <form action="{{route('application.send')}}" method="POST">
    @csrf
    <div id="total" > GPA - {{$users[0]->cgpa}} </div>
    <div>Institute - {{$users[0]->university}} </div>
    
    @foreach($coursesavailable as $key => $course)
    
    @php 
    $coursename = DB::table('courses')->where('courses.id',$course)->get();
    @endphp
    <div>Programme/Course - {{$coursename[0]->name}} </div>
    @endforeach
    <input type="hidden" value="{{$user->id}}" name="sid" class="form-control" >
</div>
</div>
<button value="send-eligibility" name="eligiblebutton" type="submit" class="btn btn-primary btncolor">send-eligibility </button>
<button value="send-eligibility" name="save-sendlater" type="submit" class="btn btn-primary btncolor">save-eligibility </button>



</form>
</div>

<div class="col-md-4">
<iframe 
    src="{{url('public/public/Image')}}/{{ $users[0]->id_image}}" 
    style="width:750px; height:500px;" 
    frameborder="0">
</iframe>
<iframe 
    src="{{url('public/public/Image')}}/{{ $users[0]->highest_qualification}}" 
    style="width:750px; height:500px;" 
    frameborder="0">
</iframe>
<iframe 
    src="{{url('public/public/Image')}}/{{ $users[0]->course_syopsiy}}" 
    style="width:750px; height:500px;" 
    frameborder="0">
</iframe>
</div>  


</div>
<div class="btn">
<a href="{{route('application.index')}}" class="btn btn-primary  btncolor float-right"> close</a>  
</div>
          <!-- /.container-fluid -->
          </div>
        </section>
        <!-- /.content -->
   
    <!-- /.content-wrapper -->
@include('admin.footer')
@endsection
</body>
<style>

  .marginbtm{
    margin-bottom:0px!important;
  }
.btncolor{
  background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
  border:none!important;
  
}

.cardcolor{
  background:#D3D3D3;
}
.searchbtn{

width: 11%;
padding: 5px;
background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 

color: white;
font-size: 17px;
border: none;
border-left: none;
cursor: pointer;

}

  </style>

</html>   