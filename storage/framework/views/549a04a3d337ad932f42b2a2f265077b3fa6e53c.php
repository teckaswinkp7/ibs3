  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="<?php echo e(route('admin.pages.index')); ?>"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active"> Edit page</li>
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
                <h3 class="card-title">Edit Page</h3>
              </div>
               <!-- /.card-header -->
               <form action="<?php echo e(route('admin.pages.update',$pages->id)); ?>" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                <?php echo csrf_field(); ?>   
                <?php echo e(method_field('POST')); ?>    
                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success mb-1 mt-1">
                            <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?> 
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Pages Name <span class="required">*</span></label>
                            <input type="text" name="title" value="<?php echo e($pages->title); ?>" id="<?php if($errors->has('name')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" placeholder="Page Name">
                            <?php $__errorArgs = ['name'];
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
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Page Slug<span class="required">*</span></label>
                            <input type="text" name="slug" value="<?php echo e($pages->slug); ?>" id="<?php if($errors->has('slug')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('slug')): ?> is-invalid <?php endif; ?>" placeholder="Pages Slug">
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
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Body <span class="required">*</span></label>
                              <textarea class="ckeditor form-control" name="body" placeholder="Body">
                                <?php echo e($pages->body); ?>

                              </textarea>
                               <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error invalid-feedback" style="display:block;"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/pages/edit.blade.php ENDPATH**/ ?>