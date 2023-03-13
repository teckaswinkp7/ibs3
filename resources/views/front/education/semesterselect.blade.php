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
                    <div class="offer">
                    <form action="{{route('semesterpost')}}" method="post">
                        @csrf
                      <div class="offer-course">
                
                    <div class="row">
                    <p> Specify which study period you would like to begin your study:</p>
                    <div class="form-check col-md-6">
  <input class="form-check-input" type="radio" name="semester" id="semester" value="semester12023">
  <label class="form-check-label" for="semester">
  2023-Semester 1
  </label>
</div>
<div class="form-check col-md-6">
  <input class="form-check-input" type="radio" name="semester" id="semester" value="semester12024">
  <label class="form-check-label" for="semester">
  2024-Semester 1
  </label>
</div>
<div class="form-check col-md-6">
  <input class="form-check-input" type="radio" name="semester" id="semester" value="semester22023">
  <label class="form-check-label" for="semester">
  2023-Semester 2
  </label>
</div>
<div class="form-check col-md-6">
  <input class="form-check-input" type="radio" name="semester" id="semester" value="semester22024">
  <label class="form-check-label" for="semester">
  2024-Semester 2
  </label>
</div>
<div class="form-check col-md-6">
  <input class="form-check-input" type="radio" name="semseter" id="semester" value="other">
  <label class="form-check-label" for="semester">
  Other
  </label>
</div>  
                          <div class="offer-btn text-right">
                      <button style="padding:5px 5px; border-radius:5px;"  type="submit" value="yes" name="accepted" >Accept</button>
                      <button style="padding:5px 5px; border-radius:5px" type="submit" value="no" name="accepted">Decline  </button>
                      
</div>
</div>                 
                      
                       

                    </div>
                   
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