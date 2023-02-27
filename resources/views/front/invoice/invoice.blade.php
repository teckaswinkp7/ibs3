<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>

@include('front.invoice.style');

</style>

<link type="text/css" rel="stylesheet" media="all" href="{{asset('assets/front/css/bootstrap.min.css')}}">
<link type="text/css" rel="stylesheet" media="all" href="{{asset('assets/front/css/jquery-ui.css')}}">
      
</head>
<body>

  <div class="congrats-letter">
                        <img class="float-right" src="{{asset('assets/front/images/IBS-Logo.png')}}" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h4> Pro Forma Invoice : {{$invoicedata[0]->invoiceno}}</h4>
                            <p>  <?php echo date("M d Y"); ?></p>
                           

                                                        
                            <div class="invoice-wrapper">

<div class="payment-details">
    <div class="row">
        <div class="col-sm-6">
            <span>invoice to: </span></br>
            <strong>
                {{$location->current_location}}
            </strong>
            <p>
{{$location->current_address_location}}</br>
    </br>
                <a href="#">
                    
{{$user->email}}
                </a>
            </p>
        </div>
        <div class="col-sm-11 text-right">
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
</div>
        <div class="row">
            <div class="col-sm-4"> <strong> Item: </strong> </div>
         <div class="col-sm-11 text-right"> <strong> Amount: </strong> </div>
        </div>

@php 
$total = 0;
@endphp
@foreach((array)$unitsData as $unit)
<div class="row item">

    <div class="col-sm-4 desc">
    {{$unit}}
    </div>
    <div class="col-sm-11 amount text-right">
    @php   
    $data = DB::table('units')->select('unit_price')->where('title',$unit)->get(); 
   $price = json_decode('data');           
  echo $data[0]->unit_price;
  $total = $total + $data[0]->unit_price;
@endphp    
    </div>
</div>
@endforeach 
    </br>
@foreach((array)$courseData as $semester)
<div class="row item">

    <div class="col-sm-4 desc">
    {{$semester}}
    </div>
    <div class="col-sm-11 amount text-right">
    @php   
    $data = DB::table('sem')->select('price')->where('name',$semester)->get();           
  echo $data[0]->price;
  $total = $total + $data[0]->price;
@endphp   
    </div>
</div>
@endforeach 
    </br>
@foreach($exist as $val)
<div class="row item">
              <div class="col-sm-4 desc" style="width:500px;">
                  {{$val}}
              </div>
                        <div class="col-sm-8 amount text-right" style="margin-left:180px;">
    @php 
     $data = DB::table('additionalfee')->select('price')->where('title',$val)->get();
     $price = json_decode('data');
     echo $data[0]->price;
     $total = $total + $data[0]->price;
     @endphp
    </div>
</div>
@endforeach 

<div  class="field total">Total Amount Payable:<span id="total" name="total"  class="float-right" >{{$total}} K</span>

    
</div>
     
    







        
        </div>
        </div>
        </div>
                          </div>
                        </div>
                                    </body>

									</html>