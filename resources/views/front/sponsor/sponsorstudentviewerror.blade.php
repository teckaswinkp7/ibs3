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


   </style>
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal" style="width: 100%;">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        <h3>Students Request</h3>

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
<table>
    <thead>
    <p class="inst">Instruction: Confirm those students that you will sponsor fundings from the following list by clicking on the “Accept” Button. If you decline a student, the student will be removed from your list to sponsor. Those whom you will accept will move from this list to the Payment list awaiting funding​</p>
    <tr class="filt">
        <form action="" method="get">
        <th scope="col"> <label for="date-range"> Date: </label> <input type='text' name="date"  class="datepicker form-control" placeholder="Date" ></input> </th>
        <th scope="col" > <label>Course :</label>
        <select name="courseid" id='course' class="form-control" style="width:200px">
         <option>All</option>
         @foreach($courses as $course)
        <option  value="{{$course->id}}" >{{$course->name}} </option>
         @endforeach
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
      <th>ID</th>
      <th >Name</th>
      <th >Course</th>
      <th >Date Submitted</th>
      <th >Invoice</th>
      <th >Amount</th>
      <th >Institute</th>
      <th >Type of student</th>
      <th >Approval</th>
    </tr>
  </thead>     
  <tbody>
    <td></td> 
    <td></td> 
    <td></td> 
    <td></td> 
    <td> No students requested yet.</td> 
    <td></td> 
    <td></td> 
    <td></td> 
 <td></td>
  <tbody>    
</table>

</div>
                      
                </div>

            </div>
        </div>
        
    </div>

    
    @include('front/footer')  

    
    @endsection   
  