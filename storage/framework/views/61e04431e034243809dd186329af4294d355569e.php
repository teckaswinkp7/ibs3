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
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/bootstrap.min.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/jquery-ui.css')); ?>">
      
</head>
<body>

  <div class="congrats-letter">
                        <img class="float-right" src="<?php echo e(asset('assets/front/images/IBS-Logo.png')); ?>" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h4> Pro Forma Invoice : <?php echo e($invoicedata[0]->invoiceno); ?></h4>
                            <p>  <?php echo date("M d Y"); ?></p>
                           

                                                        
                            <div class="invoice-wrapper">

<div class="payment-details">
    <div class="row">
        <div class="col-sm-6">
            <span>invoice to: </span></br>
            <strong>
                <?php echo e($location->current_location); ?>

            </strong>
            <p>
<?php echo e($location->current_address_location); ?></br>
    </br>
                <a href="#">
                    
<?php echo e($user->email); ?>

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

<?php 
$total = 0;
?>
<?php $__currentLoopData = (array)$unitsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row item">

    <div class="col-sm-4 desc">
    <?php echo e($unit); ?>

    </div>
    <div class="col-sm-11 amount text-right">
    <?php   
    $data = DB::table('units')->select('unit_price')->where('title',$unit)->get(); 
   $price = json_decode('data');           
  echo $data[0]->unit_price;
  $total = $total + $data[0]->unit_price;
?>    
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </br>
<?php $__currentLoopData = (array)$courseData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row item">

    <div class="col-sm-4 desc">
    <?php echo e($semester); ?>

    </div>
    <div class="col-sm-11 amount text-right">
    <?php   
    $data = DB::table('sem')->select('price')->where('name',$semester)->get();           
  echo $data[0]->price;
  $total = $total + $data[0]->price;
?>   
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </br>
<?php $__currentLoopData = $exist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row item">
    <div class="col-sm-4 desc">
        <?php echo e($val); ?>

    </div>
    <div class="col-sm-11 amount text-right">
    <?php 
     $data = DB::table('additionalfee')->select('price')->where('title',$val)->get();
     $price = json_decode('data');
     echo $data[0]->price;
     $total = $total + $data[0]->price;
     ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<div class="total">
<div  class="field total">
    Total Amount Payable:   <span id="total" name="total"  class="float-right">

             <?php echo e($total); ?>



         </span>

    
</div>
    </div> 
    







        
        </div>
        </div>
        </div>
                          </div>
                        </div>
                                    </body>

									</html><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/invoice/invoice.blade.php ENDPATH**/ ?>