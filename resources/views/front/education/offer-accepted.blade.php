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
.dropdown-container {
  display: none;
}

.dropdown-btn {
 
  cursor: pointer;
  outline: none;
}

    </style>
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
            </div>  
            <h3>Your offer</h3>
            <div class="row">
                <div class="col-sm-3">
                <div class="profile-course sidenav">
                
                  
                <ul>

                 <li> <a href="userprofile">Profile</a></li>
                  <li><a href="useroffer">Course</a></li>
                  <a class="dropdown-btn"> Bill <i class="fa fa-caret-down"></i> </a>
  

<div class="dropdown-container">
  <a href="proformainvoice">Invoice</a>
  <a href="confirmpayment">Payment</a>
  <a href="history">History</a>
</div>
             </ul>
</div> 
                </div>
                <div class="col-sm-9">
                    <p>From the documents you have submitted, you are eligible for the following courses listed below. Kindly make your choice of the course you would like to study at IBS University and receive your offer</p>
                    <div class="offer">
                        <div>
                            <h6>Accept Offer</h6>
                            <p>If you accept the offer, you will receive a Conditional Letter of Acceptance into the university confirming your space for studying; </p>
                        </div>
                        <div>
                            <h6>Decline Offer</h6>
                            <p>If you decline the offer, you will be given the choice to select again a different programme offered by the university </p>
                        </div>
                        <div>
                            <h6>Defer Offer</h6>
                            <p>If you defer your offer, your offer will be post-ponded to a time you will set to accept your offer and claim your space at that time </p>
                        </div>

                    </div>
                    <form action="{{route('semesterselect')}}" method="post">
                        @csrf
                      <div class="offer-course">
                        
                       
                        <a href="#" class="congrats">
                          Document :  <span style="font-weight:800;"> Conditional Offer Letter  </span><br>
                          Programme: <span>  {{$student_course_offer[0]->courses_name}} </span> <br>
                          Due Date :                                                            <br>
                          Status: Pending Acceptance
                          
                          <div class="offer-btn float-right">
                      <button style="padding:5px 5px;"  type="submit" value="yes" name="accepted" >Accept</button>
                      <button style="padding:5px 5px;" type="submit" value="no" name="accepted">Decline  </button>
                      <button style="padding:5px 5px;" type="submit" value="defer" name="accepted">Defer </button>
                     
                      
</div>
                          
                        </a>
                      </div>
                      <div class="offer-btn float-right">
                     
                    
                       
                    </form>
                    <button class=""><a style="text-decoration:none; margin-left:10px; color:#fff;" href="{{url('useroffer')}}">Back</a></button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @include('front/footer') 
    <script> 
    var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}




   </script>
    <style>
    .btnslct{

background-color:#cc6600;
border:none;
border-radius:0px;


}
    
    @endsection  