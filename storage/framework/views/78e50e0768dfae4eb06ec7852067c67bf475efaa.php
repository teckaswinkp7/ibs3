  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
    <div class="background-otp" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="./New Project (14).png" alt="" width="120px"></a>
            </div>  
            <h3>Confirm your email</h3>
            <p>You should receive an email containing your code/one-time password (OTP) to verify your email. Kindly copy and paste code here to confirm</p>
            <p>Time: 5 minutes</p>
            <form action="<?php echo e(route('validateOtp')); ?>" method="POST" class="register-form">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="">Code</label>
                    <input type="text" placeholder="" id="otp" name="otp">
                    
                </div>
                <div class="otp-btn">
                    <button type="submit">Confirm</button>
                </div>
                <p>Didn't recieve the code?</p>
                <a href="#">Resend code</a>
          </form>

          

          
        </div>
    </div>
<?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php $__env->stopSection(); ?>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/auth/otp.blade.php ENDPATH**/ ?>