  
<?php $__env->startSection('content'); ?> 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    <?php echo $__env->make('front/leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
        <div class="col-md-9">
            <form action="<?php echo e(route('education.create.step.one.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card mt-5">
                    <div class="card-header">Step 1: Basic Info</div>

                    <div class="card-body">

                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name"  value="<?php echo e($user[0]->name ?? ''); ?>" name="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text"  class="form-control" id="email" value="<?php echo e($user[0]->email ?? ''); ?>" name="email" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text"  class="form-control" id="phone" value="<?php echo e($user[0]->phone ?? ''); ?>" name="phone" readonly/>
                            </div>

                        
                    </div>
                    <?php if(Auth::user()->user_role == 2): ?>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary float-right">Next</button>
                    </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php $__env->stopSection(); ?>
</body>
</html>   

<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/education/create-step-one.blade.php ENDPATH**/ ?>