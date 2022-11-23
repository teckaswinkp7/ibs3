  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="<?php echo e(route('courses.index')); ?>"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">Add Course</li>
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
                <h3 class="card-title">Add Course</h3>
              </div>
               <!-- /.card-header -->
               <form action="<?php echo e(route('courses.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                <?php echo csrf_field(); ?>    
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Name <span class="required">*</span></label>
                            <input type="text" name="name" id="<?php if($errors->has('name')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" placeholder="Course Name">
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
                            <label>Course Slug<span class="required">*</span></label>
                            <input type="text" name="slug" id="<?php if($errors->has('slug')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('slug')): ?> is-invalid <?php endif; ?>" placeholder="Course Slug">
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
                          <!-- /.col -->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Course Category</label>
                                <select type="text" name="cat_id" id="cat_id"  class="form-control">
                                    <option value="">None</option>
                                     <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cat_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value='<?php echo e($cat_data->id); ?>'><?php echo e($cat_data->name); ?></option>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                          </div>
                            <!-- /.form-group -->
                            <div class="col-md-12">
                        <div class="form-group d-none" id="child_cat_div">
                          <label>Select Course SubCategory</label>
                          <select class="browser-default custom-select" name="subcat_id" id="subcat_id">
                          </select>
                        </div>
                      </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Course Image<span class="required">*</span></label>
                              <input type="file" class="form-control"  name="course_image" id="<?php if($errors->has('course_image')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('course_image')): ?> is-invalid <?php endif; ?>">
                              <?php $__errorArgs = ['course_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="error invalid-feedback d-block"><?php echo e($message); ?></span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>  
                            </div>
                          </div>
                          <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Duration<span class="required">*</span></label>
                            <input type="text" name="course_duration" id="<?php if($errors->has('course_duration')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('course_duration')): ?> is-invalid <?php endif; ?>" placeholder="Course Duration">
                            <?php $__errorArgs = ['course_duration'];
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
                            <label>Course ID<span class="required">*</span></label>
                            <input type="text" name="course_id" id="<?php if($errors->has('course_id')): ?> inputError <?php endif; ?>" class="form-control <?php if($errors->has('course_id')): ?> is-invalid <?php endif; ?>" 
                            placeholder="Course ID">
                            <?php $__errorArgs = ['course_id'];
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
                              <label>Short Description<span class="required">*</span></label>
                              <textarea class="ckeditor form-control" name="short_description" placeholder="Short Description">
                              </textarea>
                               <?php $__errorArgs = ['short_description'];
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
                            <div class="col-md-12">
                            <div class="form-group">
                              <label>Description<span class="required">*</span></label>
                              <textarea class="ckeditor form-control" name="description" placeholder="Description">
                              </textarea>
                               <?php $__errorArgs = ['description'];
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
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(document).ready(function () {
$('#cat_id').on('change',function(e) {
  alert("hi");
var cat_id = e.target.value;
$.ajax({
url:"<?php echo e(route('subcat')); ?>",
type:"POST",
data: {
cat_id: cat_id
},
success:function (data) {
$('#subcat_id').empty();
 $('#child_cat_div').addClass('d-none');
if(data.subcategories[0].subcategories==""){
  $('#child_cat_div').addClass('d-none');
}
$.each(data.subcategories[0].subcategories,function(index,subcat_id){
$('#child_cat_div').removeClass('d-none');
$('#subcat_id').append('<option value="'+subcat_id.id+'">'+subcat_id.name+'</option>');
})
}
})
});
});
</script>
<?php $__env->stopSection(); ?>
</body>
</html>   
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/courses/create.blade.php ENDPATH**/ ?>