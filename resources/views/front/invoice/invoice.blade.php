<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>@yield('title')</title>
      <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/jquery-ui.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/fonts/icomoon/style.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/jquery.fancybox.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-datepicker.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/aos.css')}}">
      <link href="{{asset('assets/front/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
      
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      
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

</head>


<body>



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

									</body>
									

<script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('assets/front/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery-ui.js')}}"></script>
  <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('assets/front/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('assets/front/js/aos.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.sticky.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.mb.YTPlayer.min.js')}}"></script>
  <script src="{{asset('assets/front/js/cloneData.js')}}"></script>
  <script src="{{asset('assets/front/js/main.js')}}"></script>
  <script src="{{asset('assets/front/js/timer.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script>

const sum = [];
const students = document.querySelectorAll('.amount');

for(student of students) {
        sum.push(parseFloat(student.innerText));             
}

document.getElementById("total").innerHTML = eval(sum.join('+'));
</script>