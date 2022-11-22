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
.required:after {
    content:" *";
    color: red;
    
  }
  .required{
    font-weight:bold;
  }
  #customFile .custom-file-control:lang(en)::after {
  content: "Select file...";
}
/*when a value is selected, this class removes the content */
.custom-file-control.selected:lang(en)::after {
  content: "" !important;
}


.custom-file-control {
  white-space: nowrap;
}

.edit-course {
    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 6px;
    border-radius: 6px;
    line-height:20px;
    color: rgba(0, 0, 0, 0.8);
    background-color: #e6e6e6;
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
      margin-left:20px;
      margin-right:30px;
      position:relative;
      left:350px;
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
#dcolor{

background:  #FFC300 ;
}
#ecolor{

background: #488e2b;
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
                <a href="#"><img src="profile-logo.png" alt="" width="100px"></a>
            </div>  
           
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="#">Profile</a>
                        <a href="#">Course</a>
                        <li><a class="bill-btn" href="#">bill
                    <span class="fas fa-caret-down"> </span>
                    <li class="bill-show">
                  <li class="bill"><a href="proformainvoice">Pro-forma-invoice</a></li>
                  <li class="bill"><a href="salesinvoice">Sales Invoice</a></li>
                  <li class="bill"><a href="payment">Payment</a></li>
                  <li class="bill"><a href="history">History</a></li>
</li>
                    </a></li>
                    </div>
                </div>
                <div class="col-sm-9">
                <div class="row">
         @if($statusis == 'Fully Paid')
         <div class="col-sm-4 text-right circle" ><span id="clabel1">Registered</span> </div>
							 <div class="col-sm-6 text-right circle"><span id="clabel2"> Not Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" > <span id="clabel3"> Partially Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" id="ecolor"> <span id="clabel4"> Fully Enrolled </span> </div>
                      @elseif($statusis == 'Partially paid')
                      <div class="col-sm-4 text-right circle" ><span id="clabel1">Registered</span> </div>
							 <div class="col-sm-6 text-right circle"><span id="clabel2"> Not Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" id="dcolor"> <span id="clabel3"> Partially Enrolled </span>  </div>
                      <div class="col-sm-8 text-right circle" > <span id="clabel4"> Fully Enrolled </span> </div>
                     @else
                     <div class="col-sm-4 text-right circle" id="ccolor" ><span id="clabel1">Registered</span> </div>
							 <div class="col-sm-6 text-right circle"><span id="clabel2"> Not Enrolled </span>  </div>
                     <div class="col-sm-8 text-right circle" > <span id="clabel3"> Partially Enrolled </span>  </div>
                     <div class="col-sm-8 text-right circle" > <span id="clabel4"> Fully Enrolled </span> </div>
                      @endif
							</div> 

               <div class="edit-course">
</br>
               <img style="width:150px; position:relative; left:220px;" src="{{asset('public/image/accept.png')}}"></img>
</br>
</br>
                <h4 style = "text-align:center;"> Reciept Submitted Succesfully </h4>
                <p> Thank you for submitting your payment receipt form. 
                    Your invoice and payment will now be sent to the Finance team for reconciliation. 
                    Once your payment has been reconciled, your payment status will be updated, 
                    and you will receive your IBS receipt here in your iConnect
                
</p>

           
<div class="submission-btn text-center">
                         <button class="btn btn-primary edit-btn" > <a href="confirmpayment"> Submit Another  Reciept </button> </a>
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