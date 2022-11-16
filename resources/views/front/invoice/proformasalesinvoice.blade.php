@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<style>

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
.agree-btn{
    padding: 10px 10px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border: none;

}
.agree-btn:hover{
    background-color: black;
    color: white;
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

.edit-btn > a {
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

</style>

    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="profile-logo.png" alt="" width="100px"></a>
            </div>  
            <h3> Sales invoice </h3>
            
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
                   
                    <form action="">
                        <div class="congrats-letter">
                        <img class="float-right" src="{{asset('assets/front/images/IBS-Logo.png')}}" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h4> Pro Forma Sales Invoice : {{$invoicedata[0]->invoiceno}}</h4>
                            <p>  <?php echo date("M d Y"); ?></p>
                           

                                                        
<div class="receipt-content">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">

					<div class="payment-details">
						<div class="row">
							<div class="col-sm-6">
								<span>invoice to: </span></br>
								<strong>
									{{$location->current_location}}
								</strong>
								<p>
                                    
                                    
                                    {{$location->current_address_location}}
									{{-- 989 5th Avenue <br>
									City of monterrey <br>
									55839 <br>
									USA <br> --}}
									<a href="#">
                                        
                                        {{$user->email}}
									</a>
								</p>
							</div>
							<div class="col-sm-6 text-right">
								<span>Issued By,</span></br>
								<strong>
									IBS University
								</strong>
								<p>
									P.O Box 2826 Boroko <br>
									NCD Port Moresby <br>
									<a href="#">
										ask@ibs.ac.pg
									</a>
								</p>
							</div>
						</div>
					</div>

					<div class="line-items">
						<div class="headers clearfix">
							<div class="row">
								<div class="col-xs-4">Item: </div>
							
								<div class="col-xs-5 text-right">Amount: </div>
							</div>
						</div>
						<div class="items">
                            @php 
                            $total = 0;
                            @endphp
                        @foreach((array)$unitsData as $unit)
                        <div class="row item">
                      
								<div class="col-xs-4 desc">
                                {{$unit}}
								</div>
                                <div class="col-xs-5 amount text-right">
                                @php   
                                $data = DB::table('units')->select('unit_price')->where('title',$unit)->get(); 
                               $price = json_decode('data');           
                              echo $data[0]->unit_price;
                              $total = $total + $data[0]->unit_price;
                            @endphp    
								</div>
							</div>
                           </div>
                
@endforeach 
                    @foreach((array)$courseData as $semester)
                           <div class="row item">
                         
								<div class="col-xs-4 desc">
                                {{$semester}}
								</div>
								<div class="col-xs-5 amount text-right">
                                @php   
                                $data = DB::table('sem')->select('price')->where('name',$semester)->get();           
                              echo $data[0]->price;
                              $total = $total + $data[0]->price;
                            @endphp   
								</div>
							</div>
						</div>
                     
                   
@endforeach     
                            @foreach($exist as $val)
							<div class="row item">
								<div style="width:700px;" class="col-xs-10 desc">
									{{$val}}
								</div>
								<div class="col-xs-5 amount text-right">
								@php 
                                 $data = DB::table('additionalfee')->select('price')->where('title',$val)->get();
                                 $price = json_decode('data');
                                 echo $data[0]->price;
                                 $total = $total + $data[0]->price;
                                 @endphp
								</div>
							</div>
                         @endforeach
                           
						<div class="total">
							<div  class="field total">
								Total Amount Payable:   <span id="total" class="col-xs-5 float-right">
                            
                                         {{$total}}


                                     </span>
							</div>	
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>                    
                                
                        </div>
                      </div>
                      
                      
                      <div class="print-download-btn">
                      <a href="{{route('invoice')}}"><button class="down"><img src="{{asset('assets/custom/download-icon.png')}}" alt="" width="15px"> Download </a></button>
                        <button class="print"> Print <img src="{{asset('assets/custom/print-icon.png')}}" alt="" width="15px"></button>    
                    </div>

                    
                   </form>
                                    </br>
                                    </br>

                   <div class="row">
			<div class="col-md-12">
                <h4> Select Your Payment Method option </h4> 
                <p> Note: IBS does not accept any form of payment in cash or cheque.kindly deposit this form of payment at the bank</p>
                <input data-toggle="modal" data-target="#refundmodal" type="radio" name="payment" value="0"> 
                <label for="payment" > Bank Direct Deposit </label>
                <input data-toggle="modal" data-target="#refundmodal" type="radio" name="payment" value="1"> 
                <label  for="payment" > Mobile Banking </label>
                <input data-toggle="modal" data-target="#refundmodal" type="radio" name="payment" value="2"> 
                <label for="payment" > Visa Payment </label>
                                    </br>
                <input data-toggle="modal" data-target="#refundmodal" type="radio" name="payment" value="3"> 
                <label for="payment" > Online Transfer </label>
                <input data-toggle="modal" data-target="#refundmodal" type="radio" name="payment" value="4"> 
                <label for="payment" > BSP Pay </label>
                                    </div>
                                    </div>

               
                                    </div>
                                    </div>
                                    </div>
                                    </div>
<!-- Modal -->

<div class="modal fade" id="refundmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="width:700px;" class="modal-title" id="exampleModalLongTitle">REFUND AGREEMENT FORM </h5>
        <h8> Acceptance of Terms & Conditions </h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('refundpolicypost')}}" method="POST" >
        @csrf
      <div class="modal-body">
     
      ​
The Refund Policy for students following at our Institution are as follows: ​

​

Request for course fee refund will only be entertained through adherence of our processes which include the correct submission of the "Letter of Withdrawal", along with the ID card received from the Institution.​

​

The eligibility and the amount of refund will be established as per the following criteria: ​

Full Refund In the unlikely event that the institution is unable to deliver a course in full, a student will be offered a refund of course money paid to date. ​

95% Refund If withdrawn after enrolment but before the commencement of the course, then 5% of the Total Course Fee Payable or unis applied to that study period will be retained, and the balance, will be refunded ​

50% Refund If withdrawn on or before the last day of the fifth week of the study period, then 50% of the Total Course Fee Payable or units applied to that study period will be retained, and the balance, will be refunded. ​

No Refund If withdrawn after 5 weeks from the commencement of the course OR if expelled for disciplinary reasons. ​

​

C.    Refunds of non-course related fees are summarized here: ​

Registration Fees Strictly non-refundable this is the fee associated with filling in accordance with legislative requirements set out by the National Government. ​

Accommodation & Transport If applicable any refunds we will calculated on a pro-rata basis (pay only  for what you used), with any outstanding balances strictly paid directly to the Sponsor’s account. ​

Stationery & Textbooks Strictly non-refundable this is due to the fact that we do not hold stock and these materials have been provisioned specifically for you. ​

​

D.   Please note that any enrolment found to contain any false information/document(s), may be cancelled     ​

       at any time with no refunds. ​

​

Any refunds for students, it will be reimbursed directly to the original account of the Sponsor ​

        (individual/ organisation who paid the fees). ​
       
      <h4>  F. I declare that: </h4>​

<input type="checkbox" value="0" name="refund[]" required  > I have read, understood and accept the terms and conditions regarding refunds outlined here.</input> ​
                                    </br>
<input type="checkbox" value="1" name="refund[]"required  > The information I have provided is accurate and complete. ​</input>
                                    </br>
<input type="checkbox"value="2" name="refund[]" required > Any discovery of falsified or incorrect information regarding this application made before, on or afterwards may result in the termination of any offer of enrolment without any refunds. </input>​
                                    </br>
​
                                    </br>
On admission into this institution, I hereby accept to abide by the code of conduct, policies and procedures.
      </div>
      <div class="modal-footer ">
        <button type="submit" class="btn text-center btn-primary agree-btn"> I Agree</button>
      </div>
    </div>
    </form> 
  </div>
</div>
 @include('front/footer')      
@endsection  