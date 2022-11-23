  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/profile.css')); ?>">

<style>

*{
   list-style-type: none;
}

    </style>
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="<?php echo e(asset('assets/custom/profile-logo.png')); ?>" alt="" width="100px"></a>
            </div>  
            <h3>Your offer</h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="userprofile">Profile</a>
                        <a href="useroffer">Course</a>
                        <li class="bill"><a href="proformainvoice">Pro-forma-invoice</a></li>
                  <li class="bill"><a href="proformasalesinvoice">Sales Invoice</a></li>
                  <li class="bill"><a href="confirmpayment">Payment</a></li>
                  <li class="bill"><a href="history">History</a></li>
                        
                    </div>
                </div>
                <div class="col-sm-9">
                    <p>From the documents you have submitted, you are eligible for the following courses listed below. Kindly make your choice of the course you would like to study at IBS University and receive your offer</p>
                    <div class="offer">
                        <div>
                            <h6>Accept Offer</h6>
                            <p>If you accept the offer, you will receive a Conditional Letter of Acceptance into the university confirming your space for studying; </p>
                        </div>
                        <div>
                            <h6>Decline Offer</h6>
                            <p>If you decline the offer, you will be given the choice to select again a different programme offered by the university </p>
                        </div>
                        <div>
                            <h6>Defer Offer</h6>
                            <p>If you defer your offer, your offer will be post-ponded to a time you will set to accept your offer and claim your space at that time </p>
                        </div>

                    </div>
                    <form action="<?php echo e(route('courseofferpost')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                      <div class="offer-course">
                        
                        <a href="#"><?php echo e($student_course_offer[0]->courses_name); ?></a>
                        <a href="#" class="congrats">
                          Congratulations! <br>
                          You have a space to study the year 1 programme, Diploma in Accounting and Finance at IBSUniversity
                        </a>
                      </div>
                      <div class="offer-btn">
                        <button type="submit" value="yes" name="accepted" >Accept</button>
                        <button type="submit" value="no" name="accepted">Decline  </button>
                        <button class=""><a style="text-decoration:none; color:#fff;" href="<?php echo e(route('coursedefer')); ?>">Defer</a></button>
                      </div>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    
    <?php $__env->stopSection(); ?>  
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/education/offer-accepted.blade.php ENDPATH**/ ?>