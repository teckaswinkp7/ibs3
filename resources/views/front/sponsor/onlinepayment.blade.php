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
.button{

padding: 5px 10px;
background-color: #cc6600;
color:white;
border-radius: 5px;
border-color: #cc6600;
}

.button >a{
color:white;
text-decoration:none;
}

   </style>
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal" style="width: 100%;">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        <h3>Confirm Payment</h3>

        <div class="row">
            <div class="col-sm-2">
                <nav class="profile-course">
                  <ul>

                   <li> <a href="sponsorprofile">Profile</a></li>
                    <li><a href="sponsorstudentview">View Students</a></li>
                    <li class="bill"><a href="payment">Payment</a></li>
                  <li class="bill"><a href="sponsorhistory">History</a></li>
                    </ul>
</nav>
            </div>
            
<div class="col-sm-10">
<table>
    <thead>
    <p class="inst">Instruction: Check the checkboxes next to the ID Column of those students that you either would like to make payment now and click the pay button on the accumulated invoice total to perform payment transection; or you have already made payment and would like to confirm their payment by clicking on the Confirm Payment Button </p>
<table>
    <table class="table table-striped">
    <thead>
    <tr>
        <th> </th>
      <th>ID</th>
      <th >Name</th>
      <th >Course</th>
      <th >Type of Student</th>
      <th >Invoice</th>
      <th >Institute</th>
      <th >Status Of Payment</th>
      <th >Amount</th>
      <th> Amount Paid </th>
    </tr>
  </thead>
           
  <tbody>
    



  <td><input type="checkbox"> </input> </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>-</td>
      <td></td>
      <td> </td>

      <tbody>
        <tfoot>
      <td> Total: </td>
</tfoot>
</table>
<button class="button" type="button"> Edit </button> 
<div class="row">
   <label required> <strong> Attach Remittance Advice* </strong> </label>
   <p>Please rename your receipt title in the following naming convention: ​

CorporateSponsorName_Remittance_Advice_CurrentDate(ddmmyy). For example, OKTediLTD_Remittance_Advise_15112022.pdf</p>

<form>
  <div class="custom-file col-sm-6">
    <input type="file" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
</form>

<div class="row">
    <div class="">
        <button class="button float-right"> Next </button>
        

</div>

</div>
                      
                </div>

            </div>
        </div>
        
    </div>
  
    
    @include('front/footer')  
    <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

    
    @endsection   
  