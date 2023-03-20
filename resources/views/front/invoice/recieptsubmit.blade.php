@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
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

.custom-file {
  overflow: hidden;
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
            
            <h3> Confirm Your Payment</h3>
            
            
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
                  
                <p> You have outstanding  on the following invoices: </p>
                <form action="{{route('recieptpost')}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="edit-course">
                        <p > Course : {{$student_course_offer[0]->courses_name}} </p>
                        <p > invoice Number : {{$invoicedata[0]->invoiceno}} </p>
                        <p> Amount Due: ${{$total[0]->amountdue}} </p>
                        <p> Issue Date :  
                        @php 
$date = $total[0]->updated_at;
$dt = new DateTime($date);
echo $dt->format('Y-m-d');
@endphp
</p>
                        <p> Due Date: {{$total[0]->duedate}}  </p>
                        <p> Balance Due: ${{$total[0]->balance_due}}  </p> 
                        <p > Status: <span class= "badge badge-danger " >{{$total[0]->status}} </span> </p>
                        
                       
                        <div>
                        <label class="required"> Enter Amount Deposited: </label></br>
                        <input name="amount_paid" type="number" min="{{$total[0]->balance_due}}" required >
                        </div>
</br>
                        <div >
                          <div class="reciept">
                        <label  class="required" for="payreciept">Attach Bank Reciept: </label></br>
                        <div class="custom-file col-sm-6">
    <input type="file" name="payreciept" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
</div>
</div>        

<div class="submission-btn text-center">
                         <button type="submit" class="btn btn-primary  edit-btn" > Submit Reciept </button> 
                        </div>
                        
</form>
               
                                    </div>
                                    </div>
                                    </div>
                        </div>
                  </div>

               
 @include('front/footer')  
 <script type="text/javascript">
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script> 
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