@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">

<style>
*{
   list-style-type: none;
}

.inst,.filt{

    font-size:10px;
}
.total-amount{
    display: block;
   
    padding: 40px 10px;
    width:40%;
    text-decoration: none;
    margin-bottom: 6px;
    border-radius: 6px;
    line-height:5px;
    color: rgba(0, 0, 0, 0.8);
    background-color: var(--bs-table-bg);
    transition: all .3s ease;
    border: 1px solid #d9d9d9;
}
.button{

    padding: 10px 10px;
    background-color: #cc6600;
    color:white;
    border-radius: 5px;
    border-color: #cc6600;
}

.button >a{
    color:white;
    text-decoration:none;
}

.styletotal{

    border:none;
    font-size: 30px;
    color:black;
    background-color: var(--bs-table-bg);
}

   </style>
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal" style="width: 100%;">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        <h3>Confirmed Students Sponsored List</h3>

        <div class="row">
            <div class="col-sm-2">
                <nav class="profile-course">
                  <ul>

                   <li> <a href="sponsorprofile">Profile</a></li>
                    <li><a href="sponsorstudentview">View Students</a></li>
                    <li class="bill"><a href="sponsoredstudents">Payment</a></li>
                  <li class="bill"><a href="sponsorhistory">History</a></li>
                    </ul>
</nav>
            </div>
            
<div class="col-sm-10">
<form action="{{route('confirmpaymentpost')}}" method="post">
    @csrf
<table >
    <thead>
    <p class="inst">Instruction: Check the checkboxes next to the ID Column of those students that you either would like to make payment now and click the pay button on the accumulated invoice total to perform payment transection; or you have already made payment and would like to confirm their payment by clicking on the Confirm Payment Button </p>
    <tr>
    
  
    <span style="top:60px;"> Accumilative Invoice Total: <span>
    <div class="total-amount">
        <div class="row">
        <div>
        <button type="submit" class="col-md-4 button float-right" style="margin-bottom:10px;" value="1" > <a href=""> Pay </button></a>  
</div>    
        <div class="col-md-4">
        <input class="styletotal" id="total" disabled></input>
        
</div>

    <div class="col">
      <button class="button float-right" type="submit" > Confirm payment </button>
</div>

     </div>
    
</div>


</tr>
    <tr class="filt">
        <form>
        <th scope="col"> <label for="date-range"> Date: </label> <input type='text' name="date-range"  class="datepicker form-control" placeholder="Date" ></input> </th>
        <th scope="col" > <label>Course :</label>
         <select id='course' class="form-control" style="width:200px">
         <option value="">All</option>
         <option value="1">Active</option>
         </select>
         </th>

        <th scope="col"> <label>Institute:</label>
         <select id='institute' class="form-control" style="width:200px">
         <option value="">All</option>
         <option value="1">Active</option>
         </select> </th>

        <th> <label>Type of Student:</label>
         <select id='typeofstudent' class="form-control" style="width:210px">
         <option value="">All</option>
         <option value="1">Active</option>
         </select></th>
<th> <button class="btn btn-primary" type="submit"  style=" padding: 5px 15px; background-color: #cc6600; border-color:#cc6600; color: white; margin-top:20px; margin-left:5px; margin-right:5px;"> Apply </button> </th>
        </form>
        <form action="">
        <th> <label for="search"> Search: </label><div class="input-group">
      <input class="form-control py-2" type="search" name="search" value="" id="example-search-input">
      <span class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" style="background-color: #cc6600; color:white;">
            <i class="fa fa-search" ></i>
        </button>
      </span>
</div>
</th>
</form>

</tr>
<table>
    <table class="table table-striped">
    <thead>
    <tr>
        <th> </th>
      <th>ID</th>
      <th >Name</th>
      <th >Course</th>
      <th >Date Submitted</th>
      <th >Invoice</th>
      <th >Institute</th>
      <th >Type of student</th>
      <th >Amount</th>
    </tr>
  </thead>
           
  <tbody>
    @foreach($sponsoredstudentdata as $sponsor)
@php 

$student = DB::table('users')->where('users.id',$sponsor->stu_id)
->join('sponsoredstudents','sponsoredstudents.stu_id','=','users.id')
->join('payment','users.id','=','payment.stu_id')
->join('invoice','users.id','=','invoice.stu_id')
->join('courses','invoice.course_id','=','courses.id')
->select('users.id','users.name','users.email','courses.name as course_name','invoice.updated_at','payment.amountdue','sponsoredstudents.stu_id','invoice.invoiceno')
->where('request_accepted','yes')->get();



@endphp
@foreach($student as $st)


  <td><input name="sponsored[]" id="sponsored" value="{{$st->stu_id}},{{$st->amountdue}}" type="checkbox"> </input></td>
      <td>{{$st->stu_id}}</td>
      <td>{{$st->name}}</td>
      <td>{{$st->course_name}}</td>
      <td>{{date('y-m-d',strtotime($st->updated_at))}}</td>
      <td>{{$st->invoiceno}}</td>
      <td></td>
      <td>-</td>
      <td>{{$st->amountdue}}</td>
      <tbody>
      @endforeach
        
      @endforeach
</table>
</form>
</div>
                      
                </div>

            </div>
        </div>
        
    </div>

    
    @include('front/footer')  
<script>
    $('input:checkbox').change(function ()
{

      var total = 0;
      $('input:checkbox:checked').each(function(){
       total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
      });   
  
      $("#total").val(total);

});
</script>
    
    @endsection   
  