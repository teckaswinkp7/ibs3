@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
<style>
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
.dropdown-container {
  display: none;
}

.dropdown-btn {
 
  cursor: pointer;
  outline: none;
}

.custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.submission-btn{

    background-color:#cc6600;
    color:white;
}

   </style>


 
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        <h3>Your Profile </h3>
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
        

                    @php 

                    $id = auth::id();
                    $offeraccepted = DB::table('courseselections')->select('offer_accepted')->where('stu_id',$id)->get();
                    @endphp 

                    @if($offeraccepted == '1')
                    <li><a href="history">History</a></li>
                    @endif
                    
                   


                    </ul>
</div>
            </div>
                <div class="col-sm-9">
                   
                    <div class="offer">
        
                        <div>
                            <h6>Defer Offer</h6>
                            <p>If you defer your offer, your offer will be post-ponded to a time you will set to accept your offer and claim your space at that time </p>
                        </div>

                    </div>
                    <form method="post" action="{{route('coursesdefer')}}">
                        @csrf
                      
                    <div class="deffer-course">       
                <input type="radio" name="defer_course" value="yes">
                <label for="yes"> Yes </label> 
                <input type="radio" name="defer_course" value="no">
                <label for="no"> No </label> 
                </div>
                <button class="submission-btn btn btn-warning" type="submit">Submit </button>
            </form>

                </div>
            </div>
            
        </div>
    </div>
    @include('front/footer')  
    <script>
      //increment upload
$(document).ready(function(){

$('.btn-success').click(function () {


var htmlData = $('.clone').html();
$('.increment').after(htmlData);

});
// Remove input

$('body').on('click','.btn-danger',function () {

$(this).parents('.xpress').remove();

});


}) 
      </script>

    
    @endsection  