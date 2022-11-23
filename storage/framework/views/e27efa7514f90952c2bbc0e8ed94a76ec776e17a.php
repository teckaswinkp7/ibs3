  
<?php $__env->startSection('content'); ?> 
<div class="site-section">
<div class="container">
<div class="row justify-content-center">   
<div class="col-md-9">
<div class="card custom-margin">
<div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <h4> <?php echo e($page->title); ?> </h4>
      <hr>
<div>
 <?php echo $page->body; ?>

</div>
</div> 
</div>
</div>
</div>
</div>
</div>
</div>

<?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php $__env->stopSection(); ?>
 
</body>

</html>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/page/view.blade.php ENDPATH**/ ?>