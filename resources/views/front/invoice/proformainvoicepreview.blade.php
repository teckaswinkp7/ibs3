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

</style>
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="profile-logo.png" alt="" width="100px"></a>
            </div>  
            <h3> Proforma invoice </h3>
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="#">Profile</a>
                        <a href="#">Course</a>
                        {{-- <a href="#"></a>
                        <a href="#"></a> --}}
                    </div>
                </div>
                <div class="col-sm-9">
                   
                    <form action="">
                      <div class="edit-course">
                        {{-- <a href="#">
                          Accounting and Finance 
                        </a> --}}
                        
                        <p > Course: {{$student_course_offer[0]->courses_name}}</p>
                        <p> Name: {{$user->name}}</p>
                        <p> Address: {{$location->current_location}} </p>
                        <p> Email: {{$user->email}}</p>
                        <p> Phone: {{$user->phone}}</p>
                      <button class="d-flex edit-btn float-right" > <a href="{{route('proformainvoice')}}">  Edit </button> </a>
                        </div>
                        <div class="congrats-letter">
                        <img class="float-right" src="{{asset('assets/front/images/IBS-Logo.png')}}" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h4> Pro Forma Invoice : {{$invoicedata[0]->invoiceno}}</h4>
                            <p>  <?php echo date("Y-m-d"); ?></p>

                                                        
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
                            
                            @foreach($exist as $val)
							<div class="row item">
								<div class="col-xs-4 desc">
									{{$val}}
								</div>
								<div class="col-xs-5 amount text-right">
									@php 
                                 $data = DB::table('additionalfee')->select('price')->where('title',$val)->get();
                                 $price = json_decode('data');
                                 echo $data[0]->price;
                                 @endphp
								</div>
							</div>
                           @endforeach
                            <div class="row item">
								<div class="col-xs-4 desc">
                                {{$invoicedata[0]->sem}}
								</div>
								<div class="col-xs-5 amount text-right">
									20
								</div>
							</div>
						</div>
                        @foreach($unitsData as $unit)
                        <div class="row item">
								<div class="col-xs-4 desc">
                                {{$unit}}
								</div>
                                
								<div class="col-xs-5 amount text-right">
                                    
                                @php                                  
                               $data = DB::table('units')->select('unit_price')->where('title',$unit)->get();            
                              echo $data[0]->unit_price;
                                @endphp    
								</div>
							</div>
                           </div>
                      
                        @endforeach
                        </br>
						<div class="total">
							<div  class="field total">
								Total Amount Payable:   <span id="total" class="col-xs-5 float-right"> </span>
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
                      <a href="{{route('invoice')}}"> <button class=""><img src="{{asset('assets/custom/download-icon.png')}}" alt="" width="15px"> </a></button>
                        <button class=""><img src="{{asset('assets/custom/print-icon.png')}}" alt="" width="15px"></button>    
                    </div>

                    
                   </form>

               
            </div>
            
        </div>
    </div>
    <script>

const sum = [];
const students = document.querySelectorAll('.amount');

for(student of students) {
        sum.push(parseFloat(student.innerText));             
}

document.getElementById("total").innerHTML = eval(sum.join('+'));
</script>
    @include('front/footer')      
    @endsection  