@extends('admin.header')  
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <form action="{{route('search.index')}}" method="GET">
            <input type="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>
</form>  
          </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
        <div class="ml-auto backgroundcolor">
        <a href="{{route('application.export')}}"> <button class="btn btn-primary btnreview"> Export Report </button></a>
</div>
              <!-- /.card-header -->
              <table class="table">
    <tr>
        <form action="{{route('application.search')}}" method="GET">
          <th class="col-4"> Filter: </th> 
          
    <th > <label for="fromdate"> From Date: </label> <input type='date' value="{{$fromdate}}" name="fromdate"  class="datepicker form-control" placeholder="Date" ></input></th>
<th> <label for="fromdate"> To Date: </label> <input type='date' name="todate" value="{{$todate}}"  class="datepicker form-control" placeholder="Date" ></input></th>
    <th > <label>Institute:</label>
         <select id='institute' name="university" class="form-control" style="width:200px">
         <option value="">All</option>
         @foreach ($institute as $inst)
         <option name="university"  value="{{$inst->title}}">{{$inst->title}}</option>
         @endforeach
         </select> </th>

<th> <button class="btn btn-primary btnreview" value="filter" type="submit" name="paybutton" style=" padding: 5px 15px; background-color: #cc6600; border-color:#cc6600; color: white; margin-top:30px; margin-left:5px; margin-right:5px;"> Apply </button> </th>
       
</form>
<form action="{{route('application.searchname')}}" method="get">
        <th> <label for="search"> Search: </label><div class="input-group">
        
      <input  placeholder="search here" class="form-control py-1" type="search" name="searchname" value="" id="example-search-input">
      
      <span class="input-group-append">
        <button class="btn btn-outline-secondary btnreview" type="submit" style="background-color: #cc6600; color:white;">
            <i class="fa fa-search" ></i>
        </button>
      </span>
      </form>
</div>
</th>


</tr>
</table>
<div class="col-12">
            
            <h3 class="card-title">Application List Panel</h3>
          </div>

                <table class="table table-striped">
    <thead>
    <tr>
      <th>ID</th>
      <th >Name</th>
      <th >Date Submitted</th>
      <th >Document</th>
      <th >Date Reviewed</th>
      <th >GPA</th>
      <th >Institute</th>
      <th >Course Spec</th>
    </tr>
  </thead>
  <?php $_SESSION['i'] = 0; ?>   
        @foreach ($users as $key  => $user)
        <?php $_SESSION['i']=$_SESSION['i']+1; ?>
  <tbody>
  <form action="" method="post" enctype="multipart/form-data">
        @csrf  
        
      <td>{{$_SESSION['i']}}</td>
      <td>{{$user->name}}</td>
      <td>{{date('d-m-Y', strtotime($user->updated_at));}}</td>
      @if($user->verificationstatus == null )
      <td><a href="{{ route('application.verify',$user->id) }}" class="btn btn-primary btnreview" > Review </a></td>
      @elseif($user->verificationstatus == 3)
      <td><a href="{{ route('application.verify',$user->id) }}" class="btn btn-success" >Send-eligibility </a></td>
      @else
      <td><a id="point" class="btn btn-secondary " > Reviewed </a></td>
      @endif
      @if($user->verificationstatus == null )
      <td></td>
      @else
      <td>{{date('d-m-Y', strtotime($user->reviewdate));}}</td>
      @endif
      
      <td>{{$user->cgpa}}</td>
      <td></td>
      @if($user->offer_accepted == 'yes')
      <td><button class="bluesharp" id="desktop"><i class="fa-sharp fa-solid fa-desktop backgroundclass"></i></button></td>
      @elseif($user->cgpa == !null)
      <td><button class="btnreview" id="desktop"><i  class="fa-sharp fa-solid fa-desktop backgroundclass"></i></button></td>
      @else
      <td> </td>
      @endif
      @endforeach
      <?php unset($_SESSION['i']); ?>    
</tbody>

        <tfoot>

</tfoot>
</table>
                
              
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

.bluesharp {

  background: #0066b2; 
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

#point{

 
 cursor:default;
}


  </style>
</html>  