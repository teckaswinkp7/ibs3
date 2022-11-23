  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="<?php echo e(route('admin.units.index')); ?>"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active"> Edit Unit  </li>
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
                <h3 class="card-title">Edit  Unit </h3>
              </div>
               <!-- /.card-header -->
               <form action="<?php echo e(route('admin.units.update',$units->id)); ?>" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                <?php echo csrf_field(); ?>  
                
                <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">

                <label for="course_id">Course*</label>
                    <select name="course_id" class="form-control" id="course_id" >
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                        </div>
</div>
</div>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Unit Name </label>
                            <input type="text" value="<?php echo e($units->title); ?>" name="title" id="<?php if($errors->has('title')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('title')): ?> is-invalid <?php endif; ?> " placeholder="Unit Name">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <span class="error invalid-feedback"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>
                        </div>
</div>
</div>
<div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Slug </label>
                            <input type="text" name="slug" value="<?php echo e($units->slug); ?>" id ="<?php if($errors->has('slug')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('slug')): ?> is-invalid <?php endif; ?>" placeholder="slug">
                             <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <span class="error invalid-feedback"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>
                        </div>
</div>
</div>

                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Video Url </label>
                            <input type="text" name="embed_id" value="<?php echo e($units->embed_id); ?>" id ="<?php if($errors->has('embeded_id')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('embeded_id')): ?> is-invalid <?php endif; ?>" placeholder="Video Url">
                             <?php $__errorArgs = ['embeded_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <span class="error invalid-feedback"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>
                        </div>
</div>
</div>


                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Short Description </label>
                            <input type="text" name="short_text" value="<?php echo e($units->short_text); ?>"  id ="<?php if($errors->has('short_text')): ?> inputError <?php endif; ?>" class="ckeditor form-control <?php if($errors->has('short_text')): ?> is-invalid <?php endif; ?>" placeholder="Short Description">
                             <?php $__errorArgs = ['short_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <span class="error invalid-feedback"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>
                        </div>
</div>
</div>
                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Description </label>
                            <input type="text" name="full_text" value="<?php echo e($units->full_text); ?>" id ="<?php if($errors->has('full_text')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('full_text')): ?> is-invalid <?php endif; ?>" placeholder=" Description ">
                             <?php $__errorArgs = ['full_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <span class="error invalid-feedback"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>
                        </div>
</div>
</div>
<div class="col-md-12">
                          <div class="form-group">
                            <label  >Unit Price</label>
                            <input class="form-control" name="unit_price" type="number" placeholder="Unit Price"> 
    
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status" >Status </label>
                            <select class="form-control" required name="published">
                            <option value="1">
                                Enabled
</option>
<option value="0"> 
  Disabled
</option>
</select>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                
                </div>
                        </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
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
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/units/edit.blade.php ENDPATH**/ ?>