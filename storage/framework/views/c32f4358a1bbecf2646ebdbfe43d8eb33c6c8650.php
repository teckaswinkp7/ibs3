  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
        <?php if(Session::has('message')): ?>
        <div class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong><?php echo e(Session::get('message')); ?></strong>
        </div>
        <?php endif; ?> 
        </div>
      </div>  
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a class="btn btn-success" href="<?php echo e(route('exam.create')); ?>"> Create Exam</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin-dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Manage Exam</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Exam</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Exam Name</th>
                  <th>Exam Description</th>
                  <th>Exam Duration</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>             
                  <?php $__currentLoopData = $exam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exams): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td><?php echo e($_SESSION['i']); ?></td>
                      <td><?php echo e($exams->exam_name); ?></td>
                      <td><?php echo e(Str::limit($exams->exam_description, 40, $end='...')); ?></td>
                      <td><?php echo e($exams->exam_duration); ?></td>
                      <td>
                        <a  href="<?php echo e(route('exam.show',$exams->id)); ?>">   
                          <i class="fa-solid  fa-eye"></i>
                        </a>
                          &nbsp;
                        <a  href="<?php echo e(route('exam.edit',$exams->id)); ?>"> 
                          <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <form method="POST" action="<?php echo e(route('exam.destroy',$exams->id)); ?>"style="display:inline-block;">
                          <?php echo csrf_field(); ?>
                          <input name="_method" type="hidden" value="POST">
                          <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                      </td>
                    </tr> 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Exam Name</th>
                  <th>Exam Description</th>
                  <th>Exam Duration</th>
                  <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php echo $__env->make('admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: 'Are you sure you want to delete this record?',
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
  <?php $__env->stopSection(); ?>
</body>
</html>  
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/exam/index.blade.php ENDPATH**/ ?>