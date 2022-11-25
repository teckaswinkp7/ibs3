  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/profile.css')); ?>">
<style>
*{
   list-style-type: none;
}

nav ul li a:hover{
   color:#51be78;
}

 .bill {
   position:static;
   display:none;
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

.hide {
  display: none;
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
    
       <h3>  Pro Forma Invoice </h3>
        <div class="row">
            <div class="col-sm-3">
                <nav class="profile-course">
                  <ul>

                   <li> <a href="userprofile">Profile</a></li>
                    <li><a href="useroffer">Course</a></li>
                  <li ><a href="proformainvoice">Pro-forma-invoice</a></li>
                  <li><a href="proformasalesinvoice">Sales Invoice</a></li>
                  <li ><a href="confirmpayment">Payment</a></li>
                  <li ><a href="history">History</a></li>
                  </ul>
                  </nav>   
</div>
            <div class="col-sm-9">
                <div class="select-course">
            
                <form action="<?php echo e(route('proformainvoicepost')); ?>" class="submission-form" method="post">
                    <?php echo csrf_field(); ?>

                  

                     <a><?php echo e($selectedcourse); ?></a>
                     
                   
                     </div>
</br>      

               <div id="select-study"> 
                <p>&nbsp;&nbsp;Select Study-type :</p></br>
                <input id="parttime" type="radio" name="stud_type" value="Part Time" onclick="show2();">
                <label for="part"> Part-time </label> 
                <input type="radio" name="stud_type" value="Full Time" onclick="show1();">
                <label for="full">Full-time </label> 
                </div>
                
                
                
                <div class="col-sm-9">
                <div id="div1" class="hide">
               <label> Units </label>
                 
                 <?php $__currentLoopData = $availableunits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $units): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

</br>
                 
                 <input type="checkbox" value="<?php echo e($units->title); ?>" name="units[]" ><?php echo e($units->title); ?></input>
                 
                
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="col-sm-9">
                <div id="div2" class="hide">
               <label> All Units </label>
                 
</br>
                 <input type="checkbox" value="<?php echo e($selectedcourse); ?>" name="allunits[]" > <?php echo e($selectedcourse); ?> </input>
                 
                
</div>

</br>
<div class="col-sm-12">
               <div id="period" class="hide"> 
                <p>Select the period you would like to make payment for :</p>
                <?php $__currentLoopData = $sem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="radio" name="sem" value="<?php echo e($semester->name); ?>">
                <label for="sem"> <?php echo e($semester->name); ?></label></br>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                </div>
</br>
           <div class="row">
            <div class="col-sm-12">
               <div class="additional-items"> 
                 
              <label>Additional Items to Include: </label>
              <?php $__currentLoopData = $additionalfee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label><input type="checkbox" name="additional_info[]" value="<?php echo e($additional->title); ?>"> <?php echo e($additional->title); ?></label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

             </div>
             </div>
</div>
</div>
</div>

<div class="submission-btn">
                    <button type="submit">  Preview </button></a>
                <button type="submit">Close</button>
            </div>

</form>
                    
                </div>

            </div>
        </div> 
    </div>
</div>
<div>

<script type="text/javascript">
function show1(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='block';
  document.getElementById('period').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
  document.getElementById('period').style.display ='none';
}
   </script>

    
    
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    
    <?php $__env->stopSection(); ?>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/invoice/proformainvoice.blade.php ENDPATH**/ ?>