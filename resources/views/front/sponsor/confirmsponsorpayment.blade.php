@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

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
.deleteRecord{

  border:none;
 background:transparent;
 padding: 0.001%;
 cursor:default!important;

}

.orange-color {
        color:orange;
    }

    .form-group {
  display: block;
  margin-bottom: 15px;
}

.form-group input {
  content:'-';
  color:white;
  -webkit-appearance: none;
  background-color: orange;
  border: 0px solid transparent;
  border-radius:50px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 0.1px 8px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 5px;
}

input:before{
  content:"-";
  color:white;
  font-size:900;
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
            
<div class="col-sm-10">
<table>
    <thead>
    <p class="inst">Instruction: Check the checkboxes next to the ID Column of those students that you either would like to make payment now and click the pay button on the accumulated invoice total to perform payment transection; or you have already made payment and would like to confirm their payment by clicking on the Confirm Payment Button </p>
<table>
    
    <table class="table table-striped">
    <thead>
    <tr>
        <th> </th>
      <th>ID</th>
      <th >Name</th>
      <th >Course</th>
      <th >Type of Student</th>
      <th >Invoice</th>
      <th >Institute</th>
      <th >Status Of Payment</th>
      <th >Amount</th>
      <th> Amount Paid </th>
    </tr>
  </thead>
    
  <tbody>
  <form action="{{route('payrecieptpost')}}" method="post" enctype="multipart/form-data">
        @csrf  
    
       
@foreach($studentpayment as $st)



  <td>
  
  <div class="form-group">
  <button type="submit"  data-id="{{$st->stu_id}}" class="deleteRecord" name="confirmsponsorpay" value="deselect" >
  <input class="checkboxx minus"  type="checkbox" name="derid[]" value="{{$st->balance_due}},{{$st->stu_id}}" ></input> 
    </button>
    </div>
  
  
   <!-- <a ><i class="fa-solid fa-circle-minus"></i></a> -->
 
  </td>
 
      <td> <input type="hidden" name="stu_id[]" value="{{$st->stu_id}}"></input>{{$st->stu_id}}</td>
      <td name="name" value="{{$st->name}}">{{$st->name}}</td>
      <td name="course_name" value="{{$st->course_name}}">{{$st->course_name}}</td>
      <td></td>
      <td>{{$st->invoiceno}}</td>
      <td>-</td>
      <td>{{$st->status}}</td>
      <td class="price" name="totalamount" value="{{$st->balance_due}}">{{$st->balance_due}} </td>
      <td><input class="price2" name="amount[]" value="" type="text">  </input></td>

</tbody>
@endforeach
        <tfoot>
      <td>  </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> <strong> Total: </strong></td>
      <td id="total"> </td>
      <td name="amount_paid" id="total2"  class="strong"> </td>

</tfoot>
</table>
<button class="button" type="button"><a href="{{route('sponsoredstudents')}}"> Edit </button></a> 
<div class="row">

   <label required> <strong> Attach Remittance Advice* </strong> </label>
   <p>Please rename your receipt title in the following naming convention: ​

CorporateSponsorName_Remittance_Advice_CurrentDate(ddmmyy). For example, OKTediLTD_Remittance_Advise_15112022.pdf</p>


  <div class="custom-file col-sm-6">
    <input type="file" name="payreciept" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>


<div class="row">
    <div class="">
        <button value="cancel" type="submit" name="confirmsponsorpay" class="button float-right" style="margin-left:2px;"> Cancel </button>
        <button value="reciept" type="submit" name="confirmsponsorpay"  class="button float-right"> Submit Recipet </button>
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
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>
    function getTotal(){
    var total = 0;
    $('.price').each(function(){
        total += parseFloat(this.innerHTML)
    });
    $('#total').text(total);
}

getTotal();

</script>
<script>
  $('.price2').blur(function () {
    var sum = 0;
    $('.price2').each(function() {
        if($(this).val()!="")
         {
            sum += parseFloat($(this).val());
         }

    });
    $('#total2').text(sum);
});


</script>

<script type="text/javascript">

  $(".deleteRecord").submit(function(e){

e.preventDefault();
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
   
    var id = $(this).data("id");

  // alert(id);
  

    $.ajax({
    
        
       url : "{{route('payrecieptpost')}}",
       method : 'POST',
        data: {id: id},
        dataType: 'text',
        success: function(data){

          console.log(id);
          
        },
        error: function(data){
          alert(data);
        }
        

  });

});


</script>




    
    @endsection   
  