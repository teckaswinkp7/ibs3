<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/jquery-ui.css')}}">
      
</head>
<body>

  <div class="congrats-letter">
                        <img class="float-right" src="{{asset('assets/front/images/IBS-Logo.png')}}" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h4> Pro Forma Invoice : {{$invoicedata[0]->invoiceno}}</h4>
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
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </body>

									</html>