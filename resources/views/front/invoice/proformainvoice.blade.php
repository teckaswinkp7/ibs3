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
                  @if($statusis == 'Fully Paid')
                  
                  <div class="col-sm-3">
                     <div class="circle" ></div>
                     <span>Registered</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Not <br> Enrolled </span> 
                  </div>

                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Partially <br> Enrolled</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle" id="ecolor"></div>
                     <span>Fully <br> Enrolled</span> 
                  </div> 
                  @elseif($statusis == 'Partially paid')
                  <div class="col-sm-3">
                     <div class="circle"></div>
                     <span>Registered</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Not <br> Enrolled </span> 
                  </div>

                  <div class="col-sm-3 " >
                     <div class="circle"  id="dcolor"></div>
                     <span>Partially <br> Enrolled</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Fully <br> Enrolled</span> 
                  </div> 
                  @else
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
                  @endif


   
                 </div>
            </div>
            
         </div>
    
       <h3>  Pro Forma Invoice </h3>
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
                <div class="select-course">
            
                <form action="{{route('proformainvoicepost')}}" class="submission-form" method="post">
                    @csrf

                  

                     <a>{{ $selectedcourse}}</a>
                     
                   
                     </div>
</br>      

               <div id="select-study"> 
                <p>&nbsp;&nbsp;Select Study-type :</p></br>
                <input id="parttime" type="radio" name="stud_type" value="Part Time" onclick="show2();">
                <label for="part"> Part-time </label> 
                <input type="radio" name="stud_type" value="Full Time" onclick="show1();">
                <label for="full">Full-time </label> 
                </div>
                
                
                
                <div class="col-sm-9">
                <div id="div1" class="hide">
               <label> Units </label>
                 
                 

</br>
@if($selectedcoursefield[0]->programme == "Diploma")


<input class="col-md-2" type="radio" value="" name="units" >2 Units</input>
@else
                 <input class="col-md-2" type="radio" value="" name="units" >1 Unit</input>
                 <input class="col-md-2" type="radio" value="" name="units" >2 Units</input>
                 <input class="col-md-2" type="radio" value="" name="units" >3 Units</input>
                 <input class="col-md-2" type="radio" value="" name="units" >4 units</input>
                 <input class="col-md-2" type="radio" value="" name="units" >5 Units</input>
                 <input class="col-md-2" type="radio" value="" name="units" >6 Units</input>
                 <input class="col-md-2" type="radio" value="" name="units" >7 units</input>
                 <input class="col-md-2" type="radio" value="" name="units" >8 Units</input>
                 
    @endif            
              
</div>

<div class="col-sm-9">
                <div id="div2" class="hide">
               <label> All Units </label>
                 
</br>
                 <input type="checkbox" value="{{$selectedcourse}}" name="allunits[]" > {{$selectedcourse}} </input>
                 
                
</div>

</br>
<div class="col-sm-12">
               <div id="period" class="hide"> 
                <p>Select the period you would like to make payment for :</p>
                @foreach ($sem as $semester)
                <input type="radio" name="sem" value="{{$semester->name}}">
                <label for="sem"> {{$semester->name}}</label></br>
              @endforeach
                
                </div>
</br>
           <div class="row">
            <div class="col-sm-12">
               <div class="additional-items"> 
                 
              <label>Additional Items to Include: </label>
              @foreach ($additionalfee as $additional)
                <label><input type="checkbox" name="additional_info[]" value="{{$additional->title}}"> {{$additional->title}}</label>
                @endforeach
                </div>

             </div>
             </div>
</div>
</div>
</div>

<div class="submission-btn">
                    <button  type="submit">  Preview </button></a>
                <button type="submit">Close</button>
            </div>

</form>
                    
                </div>

            </div>
        </div> 
    </div>
</div>
<div>


    
    
    @include('front/footer')  
    <script type="text/javascript">
function show1(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='block';
  document.getElementById('period').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
  document.getElementById('period').style.display ='none';
}



/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
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