  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/profile.css')); ?>">
<style>

.edit-course {
    display: block;
   
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

    position:relative;
    bottom:60px;
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
.profile-modal{

  background:#EDEDED;
}

.circle{
   width: 25px;
      height: 25px;
      -webkit-border-radius: 25px;
      -moz-border-radius: 25px;
      border-radius: 25px;
      border:1px solid gray;
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
.progress-bar span{
   font-size: 14px;
}
.progress-logo{
    display: flex;
    justify-content: space-between;
}


</style>


    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
        <div class="progress-logo">
        <div class="profile-logo">
            <a href="#"><img src="<?php echo e(asset('assets/custom/profile-logo.png')); ?>" alt="" width="100px"></a>
         </div>
         <div class="progress-bar">
               <div class="row">
                  <?php if($statusis == 'Fully Paid'): ?>
                  
                  <div class="col-sm-3">
                     <div class="circle" ></div>
                     <span>Registered</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Not <br> Enrolled </span> 
                  </div>

                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Partially <br> Enrolled</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle" id="ecolor"></div>
                     <span>Fully <br> Enrolled</span> 
                  </div> 
                  <?php elseif($statusis == 'Partially paid'): ?>
                  <div class="col-sm-3">
                     <div class="circle"></div>
                     <span>Registered</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Not <br> Enrolled </span> 
                  </div>

                  <div class="col-sm-3 " >
                     <div class="circle"  id="dcolor"></div>
                     <span>Partially <br> Enrolled</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Fully <br> Enrolled</span> 
                  </div> 
                  <?php else: ?>
                  <div class="col-sm-3">
                     <div class="circle" id="ccolor"></div>
                     <span>Registered</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle"></div>
                     <span>Not <br> Enrolled </span> 
                  </div>

                  <div class="col-sm-3 " >
                     <div class="circle"  ></div>
                     <span>Partially <br> Enrolled</span> 
                  </div>
                  <div class="col-sm-3 " >
                     <div class="circle" ></div>
                     <span>Fully <br> Enrolled</span> 
                  </div> 
                  <?php endif; ?>


   
                 </div>
            </div>
            
         </div>
            <h3> Proforma invoice </h3>
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="userprofile">Profile</a>
                        <a href="useroffer">Course</a>
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
                      <div class="edit-course">
                        
                        
                        <p > Course: <?php echo e($student_course_offer[0]->courses_name); ?></p>
                        <p> Name: <?php echo e($user->name); ?></p>
                        <p> Address: <?php echo e($location->current_location); ?> </p>
                        <p> Email: <?php echo e($user->email); ?></p>
                        <p> Phone: <?php echo e($user->phone); ?></p>
                      <button class="d-flex edit-btn float-right" > <a href="<?php echo e(route('proformainvoice')); ?>">  Edit </button> </a>
                        </div>
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
          </div>
							<div class="row">
								<div class="col-sm-4"> <strong> Item: </strong> </div>
							 <div class="col-sm-8 text-right"> <strong> Amount: </strong> </div>
							</div>

              <?php 
                    $total = 0;
                    ?>
                <?php $__currentLoopData = (array)$unitsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row item">
              
                        <div class="col-sm-4 desc">
                        <?php echo e($unit); ?>

                        </div>
                        <div class="col-sm-8 amount text-right">
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
                        <div class="col-sm-8 amount text-right">
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
                        <div class="col-sm-8 amount text-right">
                        <?php 
                         $data = DB::table('additionalfee')->select('price')->where('title',$val)->get();
                         $price = json_decode('data');
                         echo $data[0]->price;
                         $total = $total + $data[0]->price;
                         ?>
                        </div>
                    </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </br>
                 <div class="total">
                    <div  class="field total">
                        Total Amount Payable:   <span id="total" name="total"  class="col-xs-5 float-right">
                    
                                 <?php echo e($total); ?>



                             </span>
               
                        
                </div>
                        </div> 
						







                            
                            </div>
                            </div>
                          
                          
                          
                        
                                                        

                      
                      
                      <div class="print-download-btn">
                      <a href="<?php echo e(route('proformainvoice')); ?>"><button class="down"><img src="<?php echo e(asset('assets/custom/edit-icon.png')); ?>" alt="" width="15px"> Edit  </a></button>
                      <a href="<?php echo e(route('invoice')); ?>"><button class="down"><img src="<?php echo e(asset('assets/custom/download-icon.png')); ?>" alt="" width="15px"> Download </a></button>
                        <button class="print"> Print <img src="<?php echo e(asset('assets/custom/print-icon.png')); ?>" alt="" width="15px"></button>    
                    </div>
                    </form>
</br>
                        </br>

 <form action="<?php echo e(route('totalpost')); ?>" method="post">
  <?php echo csrf_field(); ?>
 <div class="edit-course2">
      
<p >When you are ready to make payment,</p> 
<p>  click on the “Request Invoice” button to obtain your official invoice :  ​</p>

<input id="total" type="hidden" name="amountdue" value="<?php echo e($total); ?>" class="col-xs-5 float-right">
          
          </input>
    <button type="submit" class="d-flex edit-btn2 float-right" >  Request Invoice </button> 
      </div>
</form>

                  
                          
                          </div>
                          </div>
                        </div>
                   
                     
                                   
                 
                  
                  
                                    	
						
				
			
		
	
  
                 
 <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>      
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/invoice/proformainvoicepreview.blade.php ENDPATH**/ ?>