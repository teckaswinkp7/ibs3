@extends('admin.header')  
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
            
            <h3 class="card-title">Courses List Panel</h3>
          
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <input type="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>

           
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
              <!-- /.card-header -->
              <div class="col-sm-12 ">
                <div class="row">
                  <div class="col-sm-2">
                  <form action="{{route('courses.searchcoursedate')}}" method="GET">
                  <label style="font-size:10px;">Institute:</label>
         <select name="institute" id='institute' class="form-control" style="width:200px">
         <option style="font-size:20px; color:orange; font:800;" value="{{$university}}" selected> {{$university}} </option>
         @foreach($institute as $inst)
         <option value="{{$inst->univ_name}}">{{$inst->univ_name}}</option>
         @endforeach
         </select>

                  </div>
                  <div class="col-sm-2">
                  <label style="font-size:10px;">Qualification:</label>
         <select name ="qualification" id='institute' class="form-control" style="width:200px">
         <option style="font-size:20px; color:orange; font:800;" value="{{$quali}}" selected> {{$quali}} </option>
         @foreach($qualification as $quali)
         <option value="{{$quali->programme}}">{{$quali->programme}}</option>
         @endforeach
         </select>

                  </div>
              
       
</div>
              <h1><a class="btn btn-success float-right colorbtn" href="{{ route('courses.create') }}"> Create Course</a></h1>
</div>
              <table class="table">
    <tr>
        
          <th> Filter: </th>
          <th> </th>
          <th > <label for="fromdate"> From Date: </label> <input style="width:160px" type='date' name="fromdate" value="{{$fromdate}}" class="datepicker form-control" placeholder="Date" ></input></th>
<th> <label for="fromdate"> To Date: </label> <input style="width:160px" type='date' name="todate" value="{{$todate}}"  class="datepicker form-control" placeholder="Date" ></input></th>
        <th > <label>programme/course</label>
         <select name="field" id='institute' class="form-control"  style="width:150px">
         <option style="font-size:20px; color:orange; font:800;" value="{{$category}}" selected> {{$category}} </option>
         @foreach($programme as $prog)
        
         <option value="{{$prog->name}}">{{$prog->name}}</option>
         @endforeach
         </select> </th>
         <th > <label>Study Period</label>
         <select id='institute' name="study_level" class="form-control" style="width:150px">
         <option style="font-size:20px; color:orange; font:800;" value="{{$studylevel}}" selected> {{$studylevel}} </option>
         @foreach($studytype as $stud)
         <option  value="{{$stud->title}}">{{$stud->title}}</option>
         @endforeach
         </select> </th>
         <th > <label>Level of Study</label>
         
         <select id='institute' class="form-control" style="width:150px">
        
         <option value="">Sem 1 </option>
         <option value="">Sem 2 </option>
         <option value="">Sem 3 </option>
         <option value="">Sem 4 </option>
         </select> </th>
         <th > <label>Study Batch</label>
         <select id='institute' class="form-control" >
         <option value="">----</option>
         </select> </th>
         <th> <button class="btn btn-primary btnreview" value="filter" type="submit" name="paybutton" style=" padding: 5px 15px; background-color: #cc6600; border-color:#cc6600; color: white; margin-top:30px;  margin-right:5px;"> Apply </button> </th>
</form>        


</tr>
<tr>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
<form action="{{route('courses.coursesearch')}}" method="get">
        <th> <div class="input-group">
      <input  placeholder="search here" class="form-control py-1" type="search" name="search" value="" id="example-search-input">
      <span class="input-group-append">
        <button class="btn btn-outline-secondary btnreview" type="submit" style="background-color: #cc6600; color:white;">
            <i class="fa fa-search" ></i>
        </button>
      </span>
</div>

</form>
</tr>
</table>


                <table class="table table-striped">
    <thead>
    <tr>
      <th>ID</th>
      <th >Start Date</th>
      <th >Course Name</th>
      <th >Additional Info</th>
      <th >Enrollment/places</th>
      <th></th>
    </tr>
  </thead>
 
  <?php $_SESSION['i'] = 0; ?>   
    @foreach ($courses as $course)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
  <tbody>
  <form action="" method="post" enctype="multipart/form-data">
        @csrf  
      <td>{{$_SESSION['i']}}</td>
      <td>{{$course->start_date}}</td>
      <td>{{ $course->name }}</td>
      <td>{{ strip_tags(Str::limit($course->description,30,'...')) }}</td>
      <td></td>
      <td> <a href="{{route('reports.enrolledusers',$course->id)}}"><button class="btnreview"> <i class="fa-regular fa-user backgroundclass"></i></a></button> <a href="{{route('reports.offer_accepted',$course->id)}}"><button class="btnreview"> <i class="fa-solid fa-hourglass-start backgroundclass"></i></a></button>&nbsp;<a href="{{route('user.create')}}"><button class="btnreview"> <i class="fa-solid fa-plus backgroundclass"></i></a></button> </td>
      @endforeach
      <?php unset($_SESSION['i']); ?>    
</tbody>

        <tfoot>
      
</tfoot>

</table>
<div class="ml-auto">
        {!! $courses->links() !!} 
</div>
                
              
              <!-- /.card-body -->
           
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @include('admin.footer') 
  @endsection
</body>
<style>
.btnreview{

  background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
  border:none!important;
}
.btnreviewicon{

background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 

}
a > .fa-user{

  color:white!important;
}
a > .fa-hourglass-start{

color:white!important;
}
a > .fa-plus{

color:white!important;
}
.colorbtn{
    background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
    border:none!important;
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

#desktop{

  border-width:10px;
}

  </style>
</html>  