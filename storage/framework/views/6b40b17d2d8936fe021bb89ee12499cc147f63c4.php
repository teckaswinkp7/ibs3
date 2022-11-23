  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
    
<div class="background-register" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="<?php echo e(asset('assets/custom/New Project (14).png')); ?>" alt="" width="120px"></a>
            </div>  
            <h3>Create your account</h3>
            <form action="<?php echo e(route('register.post')); ?>" method="POST" class="register-form">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="">Full Name</label>
                    <input type="text" placeholder="" name="name">
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="">Email Address</label>
                    <input type="email" placeholder="" name="email" >
                    <?php if($errors->has('email')): ?>
                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="text" placeholder="" name="phone" >
                    <?php if($errors->has('phone')): ?>
                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="register-btn">
                    <button type="submit">Register</button>
                </div>
            
          </form>
        </div>
    </div>
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
    <?php $__env->stopSection(); ?>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/auth/register.blade.php ENDPATH**/ ?>