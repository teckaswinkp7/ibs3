  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="<?php echo e(route('screening.index')); ?>"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(route('admin-dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">Course Selection</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Course Selection</h3>
              </div>
               <!-- /.card-header -->
               <form action="<?php echo e(route('screening.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                <?php echo csrf_field(); ?>    
                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success mb-1 mt-1">
                            <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="row"> 
                        <div class="col-md-12">
                              <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="<?php echo e($user->name); ?>" name="name" class="form-control"  readonly>
                                <input type="hidden" value="<?php echo e($user->id); ?>" name="stu_id" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="<?php echo e($user->email); ?>" name="email" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="<?php echo e($user->phone); ?>" name="phone" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Please Select Course</label><br/>
                                <?php $__currentLoopData = $course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="checkbox" name="course_id[]" value="<?php echo e($courses->id); ?>">
                                <label class="check">&nbsp;<?php echo e($courses->name); ?></label><br/>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                              </div>
                            </div> 
                            
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php echo $__env->make('admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
</body>
</html>   
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/screening/course.blade.php ENDPATH**/ ?>