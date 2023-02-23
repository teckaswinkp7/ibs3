@extends('admin.header')  
@section('content') 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h6> Dashboard </h6>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="float-sm-right">
              <form action="{{route('search.index')}}" method="GET">
             <input type="search" name="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>
</form>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        

        <div class="row">
          @php 

          $date = now()->isoFormat('MMM Do YYYY');

          $courseselection = DB::table('users')->where('offer_accepted','yes')->count();
          $invoices = DB::table('invoice')->count();
         
          $iconnectaccounts = DB::table('users')->where('user_role','!=','1')->count();
          $activeusers = DB::table('active_users')->join('users','users.id','=','active_users.user_id')->where('users.user_role','!=','1')->count();
          $activeenrollment = DB::table('active_users')
          ->join('users','users.id','=','active_users.user_id')
          ->leftjoin('sponsors','sponsors.stu_id','=','users.id')
          ->where('users.user_role','!=','2')
          ->orWhere('users.user_role','!=','3')
          ->get();
          $enrollment = DB::table('payment')->where('balance_due','0')->count();
          $payment = DB::table('payment')->where('amountdue','!=','balance_due')->count();
          $application = DB::table('users')
     ->join('education','users.id','=','education.stu_id')
     ->select('users.name','education.updated_at','users.id')
     ->where('users.user_role',2)
     ->where('users.status',2)
     ->count();


          @endphp
  <!-- Responsive Arrow Progress Bar -->
  <div class="col-12">
  
  <div class="d-flex p-2 justify-content-center">{{$date}} </div>
  <div class="arrow-steps clearfix">
  <div class="d-flex" > Enrollment Progress Bar.  </div>
    <div class="step"> <span class="text-start"> Application </span>  <div > <a href="#" class="numberclass" >{{$application}}</a> </div> </div>
    <div class="step"> <span>Course Selection </span> <div> <a href="#" class="numberclass" >{{$courseselection}}</a> </div></div>
    <div class="step"> <span>Offer </span> <div> <a href="#" class="numberclass" >2</a> </div></div>
    <div class="step"> <span> Invoice</span> <div> <a href="#" class="numberclass" >{{$invoices}}</a> </div> </div>
    <div class="step"> <span>Payment </span> <div> <a href="#" class="numberclass" >{{$payment}}</a> </div></div>
    <div class="step"> <span>Enrollment</span> <div> <a href="#" class="numberclass" >{{$enrollment}}</a> </div> </div>
  </div>
</div>
</div>
<br>

<div class="container">
<div class="row">

<div class="col-md-4">
  <div class="card">
<span> Total iconnect Accounts Created.</span>
<div class="card">
<div class="card-body "> 

<div class="text-center numberclass" > {{$iconnectaccounts}} </div>

</div>
</div>

</div>
</div>
<div class="col-md-4">
  <div class="card">
<span> Daily iconnect Active Accounts.</span>
<div class="card">
<div class="card-body "> 

<div class="text-center numberclass" > {{$activeusers}} </div>

</div>
</div>


</div>
</div>

<div class="col-md-4">
  <div class="card">
<span>Active Enrollment Officer</span>
<div class="card">
<div class="card-body "> 
@foreach($activeenrollment as $active)
<div class="row">

<div class="col-md-4">

<div class="text-center" > <img src="{{asset('public/Image')}}/{{$active->user_image}}" alt="" width="50px" style="border-radius:50px;border:4px solid #fd7e14;"> </img>

</div>
</div>

<div class="col-md-4">

<div class="text-center" > {{ $active->name}}</div>
<div class="text-center" style="width:200px;" > @if( $active->user_role == '1') Admin @else Enrollment Officer @endif </div>
</div>

</div>
<hr></hr>
@endforeach

</div>
</div>


</div>
</div>




<div>
</div>









          <!--<div class="col-lg-3 col-6">
           
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
          <!-- ./col -->
          <!--<div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
          <!-- ./col -->
          <!--<div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
          <!-- ./col -->
          <!--<div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
          <!-- ./col -->
       
        <!-- /.row -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@include('admin.footer')  
@endsection
</body>
<style>


.clearfix:after {
  clear: both;
  content: "";
  display: block;
  height: 0;
}

/* Responsive Arrow Progress Bar */

.container {
  font-family: 'Lato', sans-serif;
}

.arrow-steps .step {
  font-size: 14px;
  text-align: center;
  color: #777;
  cursor: default;
  margin: 0 1px 0 0;
  padding: 30px 0px 30px 0px;
  width: 16%;
  float: left;
  position: relative;
  background-color: #ddd;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.arrow-steps .step a {
  color: #777;
  text-decoration: none;
}

.arrow-steps .step:after,
.arrow-steps .step:before {
  content: "";
  position: absolute;
  top: 0;
  right: -17px;
  width: 0;
  height: 0;
  border-top: 19px solid transparent;
  border-bottom: 17px solid transparent;
  border-left: 17px solid #ddd;
  z-index: 2;
}

.arrow-steps .step:before {
  right: auto;
  left: 0;
  border-left: 17px solid #fff;
  z-index: 0;
}

.arrow-steps .step:first-child:before {
  border: none;
}

.arrow-steps .step:last-child:after {
  // border: none;
}

.arrow-steps .step:first-child {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.arrow-steps .step:last-child {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.arrow-steps .step span {
  position: relative;
}

*.arrow-steps .step.done span:before {
  opacity: 1;
  content: "";
  position: absolute;
  top: -2px;
  left: -10px;
  font-size: 11px;
  line-height: 21px;
}

.arrow-steps .step.current {
  color: #fff;
  background-color: #5599e5;
}

.arrow-steps .step.current a {
  color: #fff;
  text-decoration: none;
}

.arrow-steps .step.current:after {
  border-left: 17px solid #5599e5;
}

.arrow-steps .step.done {
  color: #173352;
  background-color: #2f69aa;
}

.arrow-steps .step.done a {
  color: #173352;
  text-decoration: none;
}

.arrow-steps .step.done:after {
  border-left: 17px solid #2f69aa;
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

.numberclass{

  font-size:25px;
  font-weight:800;
  color:black;


}
  </style>
</html>   