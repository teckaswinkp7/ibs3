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

nav ul li a:hover{
   color:#51be78;
}

 .bill {
   position:static;
   display:none;
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

.hide {
  display: none;
}
   </style>
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        <h3>  Pro Forma Invoice </h3>
        <div class="row">
            <div class="col-sm-3">
                <nav class="profile-course">
                  <ul>

                   <li> <a href="userprofile">Profile</a></li>
                    <li><a href="useroffer">Course</a></li>
                    
                    <li><a class="bill-btn" href="#">bill
                    <span class="fas fa-caret-down"> </span>
                    <li class="bill-show">
                  <li class="bill"><a href="proinvoice">Pro-forma-invoice</a></li>
                  <li class="bill"><a href="salesinvoice">Sales Invoice</a></li>
                  <li class="bill"><a href="payment">Payment</a></li>
                  <li class="bill"><a href="history">History</a></li>
</li>
                    </a></li>


                    </ul>
</nav>
            </div>
            <div class="col-sm-9">
                <div class="select-course">
            
                <form action="{{route('proformainvoicepost')}}" class="submission-form" method="post">
                    @csrf

                   @foreach ($selectedcourse as $course)

                     <a>{{ $course->name }}</a>
                     @endforeach
                     </div>
</br>      

               <div id="select-study"> 
                <p>&nbsp;&nbsp;Select Study-type :</p></br>
                <input id="parttime" type="radio" name="study_type" value="Part Time" onclick="show2();">
                <label for="part"> Part-time </label> 
                <input type="radio" name="study_type" value="Full Time" onclick="show1();">
                <label for="full">Full-time </label> 
                </div>
                
                
                
                <div class="col-sm-9">
                <div id="div1" class="hide">
               <label> Units </label>
                 
                 @foreach ($availableunits as $units)
</br>
                 <input type="checkbox" value="{{$units->id}}" name="units[]" >{{$units->title}}</input>
                
                 @endforeach
</div>



</br>


                <div class="col-sm-12">
               <div id="period"> 
                <p>Select the period you would like to make payment for :</p>
                <input type="radio" name="payment_period" value="Sem 1">
                <label for="Sem 1"> Semester 1 only </label></br>
                <input type="radio" name="payment_period" value="Sem 2 ">
                <label for="Sem 2">Semester 2 only </label> </br>
                <input type="radio" name="payment_period" value="Sem 1 and 2">
                <label for="Sem 1 and 2"> Semester 1 and 2 </label> 
                
                </div>
</br>
            <div class="col-sm-12">
               <div class="additional-items"> 
              <label>Additional Items to Include: </label></br>
                
                <label><input type="checkbox" name="additional_item[]" value="Accomodation(Sem 1 only)"> Accomodation(Sem 1 only)</label>
                <label><input type="checkbox" name="additional_item[]" value="Transporation(Sem 1 only)"> Transporation(Sem 1 only)</label>
                <label><input type="checkbox" name="additional_item[]" value="Accomodation(Sem 1 and 2)"> Accomodation(Sem 1 and 2)</label>
                <label><input type="checkbox" name="additional_item[]" value="Transportation(Sem 1 and 2)"> Transportation(Sem 1 and 2)</label>

               
                
                </div>

</div>
</div>
</div>
</div>

<div class="submission-btn">
                    <button type="submit">  Preview </button></a>
                <button type="submit">Close</button>
            </div>

</form>
                    
                </div>

            </div>
        </div>
        
    </div>
</div>
<div>

<script type="text/javascript">
function show1(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
}
   </script>

    
    
    @include('front/footer')  

    
    @endsection   