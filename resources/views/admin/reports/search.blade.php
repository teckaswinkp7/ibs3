@extends('admin.header')  
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
            
            <h3 class="card-title">Manage Enrolments</h3>
          
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <input type="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>
           </ol>
           
          </div>
          <div class="col-sm-12" style="margin-top:30px;">
          <h1><a class="btn btn-success float-right colorbtn" href="{{ route('courses.create') }}"> Export Report</a></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-4">
            <p style="font-size:15px;"> Main Filter Summary </p>
            <div class="card">
                <div class="card-body cardcolor" style="font-size:10px;">
               
                <p > Institute: </p>
                <p> Qualification: </p>
                <p> Date Range: </p>
                <p> Programme:  </p>
                <p> Study Period:  </p> 
                <p> Level of Study: </p>

                </div>

</div>
</div>
         
              <!-- /.card-header -->
              
              <table class="table col-md-8 tableheight">
    <tr style="border-top:none;" >
    
        <form action="" method="get">

          <th > </th>
          <th style="vertical-align:bottom;" > <label>Number of Units: </label>
         <select id='institute' class="form-control" style="width:200px">
         <option value="">Semester 2</option>
         <option value="">Active</option>
         </select> </th>
         <th style="vertical-align:bottom;" > <label>Payment Status: </label>
         <select id='institute' class="form-control" style="width:200px">
         <option value="">Semester 2</option>
         <option value="">Active</option>
         </select> </th>
         <th style="vertical-align:bottom;"> <button class="btn btn-primary btnreview" value="filter" type="submit" name="paybutton" style=" padding: 5px 15px; background-color: #cc6600; border-color:#cc6600; color: white; margin-top:30px; margin-left:5px; margin-right:5px;"> Apply </button> </th>
</form>   
<form action="">
        <th style="vertical-align:bottom;"><label> Search: </label> <div class="input-group">
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
      <th >Name</th>
      <th >Course</th>
      
      <th> No of Units </th>
      <th > Payment Status</th>
      <th> </th>
      <th >More Details</th>
      
    </tr>
  </thead>
  <?php $_SESSION['i'] = 0; ?>   
  @foreach ($paymentlist as $user)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
  <tbody>
  <form action="" method="post" enctype="multipart/form-data">
        @csrf  
      <td>{{$_SESSION['i']}}</td>
      <td>{{ $user->name }} </td>
      <td></td>
      <td></td>
      @if( $user->offer_accepted == 'yes')
      <td> Offer Accepted </td>
      @else
      <td> Pending Acceptance </td>
      @endif
      <td>  </td>
      <td><button class="btnreview" id="desktop"><i class="fa-sharp fa-solid fa-bars backgroundclass"></i></button></td>
      
      @endforeach
      <?php unset($_SESSION['i']); ?>    
</tbody>

        <tfoot>

</tfoot>
   
</table>
<div class="ml-auto">

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
.colorbtn{
    background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
    border:none!important;
}
.cardcolor{


background:#dee2e6;
margin-bottom:1px;
}
p{
margin-bottom:1px!important;

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

.tableheight{

    height:30px;
    margin-top:60px;
   
}

  </style>
</html>  