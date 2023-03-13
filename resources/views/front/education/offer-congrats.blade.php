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

    .congrats-btn {
    text-align: right;
}
.proinvoice-btn > a{

    color:white;
    text-decoration:none;

}
.congrats-btn button{
    padding: 12px 35px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border-radius: 10px;
    border: none;
}

.congrats-btn button:hover{
    background-color: black;
    color: white;

}

.congrats-btn button{
    padding: 10px 30px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border: none;
}

.congrats-btn button:hover{
    background-color: black;
    color: white;

}

.congrats-course > a{
    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 2px;
    border-radius: 6px;
    color: rgba(0, 0, 0, 0.8);
    background-color: white;
    transition: all .3s ease;
    border: 1px solid #d9d9d9;
   }

   .congrats-letter{
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0, 0, 0, 0.6);
    border-radius: 6px;
   }

   .congrats-letter ul{
    list-style: number;
   }
   .print-download-btn{
    margin-top: 30px;
   }

   .print-download-btn button{
    padding: 3px 6px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border: none;
}

.print-download-btn button:hover{
    background-color: black;
    color: white;

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
                <a href="#"><img src="profile-logo.png" alt="" width="100px"></a>
            </div>  
            <h3>Congratulations</h3>
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
                    <p>Congratulations! You have been accepted to study the following programme at IBSUniversity</p>
                    <form action="">
                      <div class="congrats-course">
                        {{-- <a href="#">
                          Accounting and Finance 
                        </a> --}}
                        <div class="congrats-letter">
                            <p> Document :    <span style="font-weight:600;"> Conditional Letter of Acceptance. </span> </p>
                            <p>Programme :  <span style="font-weight:600;"> {{$student_course_offer[0]->courses_name}}</span> </p>
                            <p> Due Date :  </p>
                            <p>Status    : <span style="font-weight:600;"> Offer Accepted  </span></p>
                            <div class="congrats-btn">
                            <a href="{{route('offerpdf')}}"> <button class="proinvoice-btn">View Offer</a></button>
                            <a href="{{route('proformainvoice')}}"> <button class="proinvoice-btn">Quotation </a></button>
                        </div>
                        </div>
                        </div>
                   </form>

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
    @endsection  