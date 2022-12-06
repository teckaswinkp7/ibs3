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
 a > .fa-circle-minus{
   color: #cc6600;

}
.strong{

    font-weight:600;
}

.edit-btn >a{

    color:white;
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
                    <li class="bill"><a href="sponsoredstudents">Payment</a></li>
                  <li class="bill"><a href="sponsorhistory">History</a></li>
                    </ul>
</nav>
            </div>
            
            <div class="col-sm-9">
<div class="row">
<div class="edit-course">
</br>
<img class="d-flex" style="width:150px; position:relative; left:350px;" src="{{asset('assets/front/images/accept.png')}}"></img>
</br>
</br>
 <h4 style = "text-align:center;"> Reciept Submitted Succesfully </h4>
 <p> Thank you for submitting your payment receipt form. 
     Your invoice and payment will now be sent to the Finance team for reconciliation. 
     Once your payment has been reconciled, your payment status will be updated, 
     and you will receive your IBS receipt here in your iConnect
 
</p>
</div>

<div class="submission-btn text-center">
          <button  class="btn btn-primary edit-btn" > <a href="confirmsponsorpayment"> Submit Another  Reciept </button> </a>
         </div>
         </div>
         </div>






</div>
</div>
                      
                </div>

            </div>
        </div>
        
    </div>
  
    
    @include('front/footer')  

    
    @endsection   
  