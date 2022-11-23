  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="<?php echo e(route('enrollment.index')); ?>"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(route('admin-dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">Update User</li>
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
                <h3 class="card-title">Verify Document</h3>
              </div>
               <!-- /.card-header -->
               
                <form action="<?php echo e(route('enrollment.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
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
                            <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  
                  <th>Board</th>
                  
                  <th>ID Image</th>
                  <th>Heighest Qualification</th>
                  <th>Course Synopsis</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  <?php $__currentLoopData = $student_edu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td><?php echo e($_SESSION['i']); ?></td>
                      
                      <td><?php echo e($user->board); ?></td>
                      
                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                      if($ext[1] == 'pdf')
                      { ?>
                        <td><a href="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->id_image); ?>" target="_blank"><img src="<?php echo e(url('public/uploads/pdf_icon.png')); ?>" style="width:100px;height:100px;"></a></td>
                      <?php }
                      else{ ?>
                        <td><a href="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->id_image); ?>" target="_blank"><img src="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->id_image); ?>" style="width:100px;height:100px;"></a></td>
                      <?php }
                      ?>

                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                      if($ext[1] == 'pdf')
                      { ?>
                        <td><a href="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->highest_qualification); ?>" target="_blank"><img src="<?php echo e(url('public/uploads/pdf_icon.png')); ?>" style="width:100px;height:100px;"></a></td>
                      <?php }
                      else{ ?>
                        <td><a href="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->highest_qualification); ?>" target="_blank"><img src="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->highest_qualification); ?>" style="width:100px;height:100px;"></a></td>
                      <?php }
                      ?>

                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                      if($ext[1] == 'pdf')
                      { ?>
                        <td><a href="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->course_syopsiy); ?>" target="_blank"><img src="<?php echo e(url('public/uploads/pdf_icon.png')); ?>" style="width:100px;height:100px;"></a></td>
                      <?php }
                      else{ ?>
                        <td><a href="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->course_syopsiy); ?>" target="_blank"><img src="<?php echo e(url('public/public/Image')); ?>/<?php echo e($user->course_syopsiy); ?>" style="width:100px;height:100px;"></a></td>
                      <?php }
                      ?>
                      
                    </tr> 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  
                  </tfoot>
                </table>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Document Verified</label>
                    <div class="form-check">
                    <label class="form-check-label" for="radio1">
                    <input type="radio" class="form-check-input" id="status" name="status" value="1">Yes
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio2">
                    <input type="radio" class="form-check-input" id="status" name="status" value="2">No
                    </label>
                    </div>
                  </div>
                  </div> 
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
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/enrollment/verify.blade.php ENDPATH**/ ?>