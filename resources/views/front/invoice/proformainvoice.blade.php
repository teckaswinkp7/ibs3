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
      margin-left:20px;
      margin-right:30px;
      position:relative;
      left:530px;
      bottom:50px;
    }
    #clabel1{

      position:absolute;
      top:35px;
      right:-20px;
    }
    #clabel2{

position:absolute;
top:30px;
right:0px;
}
#clabel3{

position:absolute;
top:30px;
right:0px;
}
#clabel4{

position:absolute;
top:30px;
right:0px;
}
#ccolor{

   background: #2b3f8e;
}

    

   </style>
    @php 
                      
                      $id= auth::id();
                      $statuscheck = DB::table('payment')->select('status')->where('stu_id',$id)->get();
                      $statusis = $statuscheck[0]->status;

                  

                      @endphp
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
         </div>  
         <div class="row">
         @if($statusis == 'Fully Paid')
         <div class="col-sm-4 text-right circle" ><span id="clabel1">Registered</span> </div>
							 <div class="col-sm-6 text-right circle"><span id="clabel2"> Not Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" > <span id="clabel3"> Partially Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" id="ccolor"> <span id="clabel4"> Fully Enrolled </span> </div>
                      @elseif($statusis == 'Partially paid')
                      <div class="col-sm-4 text-right circle" ><span id="clabel1">Registered</span> </div>
							 <div class="col-sm-6 text-right circle"><span id="clabel2"> Not Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" id="ccolor"> <span id="clabel3"> Partially Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" > <span id="clabel4"> Fully Enrolled </span> </div>
                     @else
                     <div class="col-sm-4 text-right circle" id="ccolor" ><span id="clabel1">Registered</span> </div>
							 <div class="col-sm-6 text-right circle"><span id="clabel2"> Not Enrolled </span>  </div>
                     <div class="col-sm-8 text-right circle" > <span id="clabel3"> Partially Enrolled </span>  </div>
                     <div class="col-sm-8 text-right circle" > <span id="clabel4"> Fully Enrolled </span> </div>
                      @endif
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
                <input id="parttime" type="radio" name="stud_type" value="Part Time" onclick="show2();">
                <label for="part"> Part-time </label> 
                <input type="radio" name="stud_type" value="Full Time" onclick="show1();">
                <label for="full">Full-time </label> 
                </div>
                
                
                
                <div class="col-sm-9">
                <div id="div1" class="hide">
               <label> Units </label>
                 
                 @foreach ($availableunits as $units)

</br>
                 
                 <input type="checkbox" value="{{$units->title}}" name="units[]" >{{$units->title}}</input>
                 
                
                 @endforeach
</div>

<div class="col-sm-9">
                <div id="div2" class="hide">
               <label> All Units </label>
                 
</br>
                 <input type="checkbox" value="{{$selectedcourse[0]->name}}" name="allunits[]" > {{$selectedcourse[0]->name}} </input>
                 
                
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
            <div class="col-sm-12">
               <div class="additional-items"> 
                 
              <label>Additional Items to Include: </label></br>
              @foreach ($additionalfee as $additional)
                <label><input type="checkbox" name="additional_info[]" value="{{$additional->title}}"> {{$additional->title}}</label>
                @endforeach
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
  document.getElementById('period').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
  document.getElementById('period').style.display ='none';
}
   </script>

    
    
    @include('front/footer')  

    
    @endsection   