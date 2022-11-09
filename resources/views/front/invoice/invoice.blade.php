
<div class="congrats-letter">
                        <img class="float-right" src="{{asset('assets/front/images/IBS-Logo.png')}}" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h1> Pro Forma Invoice  {{$invoiceid[0]->invoiceno}} </h1>
                            <p>
                                <?php echo date("Y-m-d"); ?>
                              

                                                        
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
									$60.00
								</div>
							</div>
                            @endforeach
							<div class="row item">
								<div class="col-xs-4 desc">
									{{$invoicedata[0]->payment_period}}
								</div>
								<div class="col-xs-5 amount text-right">
									$60.00
								</div>
							</div>
							
						</div>
                        </br>
						<div class="total">
							<div  class="field total">
								Total Amount Payable:   <span class="col-xs-5 float-right"> $379.00 </span>
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