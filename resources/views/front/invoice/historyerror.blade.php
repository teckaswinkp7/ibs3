@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<style>
    .profile-modal{

background:#EDEDED;
}

.edit-course {
    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 6px;
    border-radius: 6px;
    line-height:5px;
    color: rgba(0, 0, 0, 0.8);
    background-color: rgba(255, 255, 255, 0.8);
    transition: all .3s ease;
    border: 1px solid #d9d9d9;
   }
   .edit-course2{

    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 6px;
    border-radius: 6px;
    line-height:5px;
    color: rgba(0, 0, 0, 0.8);
    background-color: #ffd4ca;
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

.total{
font-weight:bold;
}

.edit-btn{

    position:relative;
    bottom:60px;
    padding: 15px 20px;
    background-color: #cc6600;
    color:white;

}
.edit-btn2{
  position:relative;
    bottom:30px;
padding: 15px 20px;
background-color: #cc6600;
color:white;

}

.edit-btn2 > a {
    color:white;
    text-decoration:none;
}
.edit-btn > a{
  color:white;
    text-decoration:none;
}

.down > a{
    color:white;
    text-decoration:none;
}
*{
   list-style-type: none;
}

nav ul li a:hover{
   color:#51be78;
}

 .bill {
   position:static;
   display:block;
}
.bill.show{
   display:block;
}



.bill-show{

   display:none;
}

nav ul li a span{
   position:absolute;
   top:50%;
   right:20px;
   transform:translateY(-50%);
   transition:transform 0.4s;
}

nav ul li a:hover span{

   transform:translateY(-50%) rotate(-180deg);
}


.circle{
   width: 25px;
      height: 25px;
      -webkit-border-radius: 25px;
      -moz-border-radius: 25px;
      border-radius: 25px;
      border:1px solid gray;
    }
#ccolor{

   background: #2b3f8e;
}
#dcolor{

background:  #FFC300 ;
}
#ecolor{

background: #488e2b;
}
.progress-bar span{
   font-size: 14px;
}
.progress-logo{
    display: flex;
    justify-content: space-between;
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
        <div class="progress-logo">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
         </div>
         <div class="progress-bar">
               <div class="row">
                  <div class="col-sm-3">
                     <div class="circle" id="ccolor"></div>
                     <span>Registered</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Not <br> Enrolled </span> 
                  </div>

                  <div class="col-sm-3 " >
                     <div class="circle"  ></div>
                     <span>Partially <br> Enrolled</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle" ></div>
                     <span>Fully <br> Enrolled</span> 
                  </div> 
              


   
                 </div>
            </div>
            
         </div>
            
            <h3> My Bill History </h3>
            
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
                <p> Pro Forma Invoice History:  </p>
                    <form action="">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                         <th> Amount </th>
                          <th> Date Raised </th>
                        <th> Document   </th>
</tr>
</thead>
                            <tbody>
                                <tr>
                                <td> - </td>
                                <td> - </td>
                                <td>- </a> </td>
</tr>
</tbody>

                        </table>

</br>
</br>


<p> Sales Invoice History:</p> 

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                         <th> Amount </th>
                          <th> Date Raised </th>
                        <th> Invoice   </th>
                        <th>Bank Reciept  </th>
                        <th> IBS Reciept  </th>
                        <th> Status  </th>
</tr>
</thead>
                            <tbody>
                                <tr>
                                <td> -</td>
                                <td> - </td>
                                <td>-</a> </td>
                                <td> - </td>
                                <td> -  </td>
                                <td> - </td>
</tr>
</tbody>

                        </table>
                  
               
                                    </div>
                                    </div>
                                    </div>
                  </div>
 @include('front/footer')      
 <script type="text/javascript" >
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