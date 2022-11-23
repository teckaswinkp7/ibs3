
<?php $__env->startSection('content'); ?>
<div class="login-box">
  <div class="card card-outline card-primary">
                  <div class="card-header text-center"> 
                    <img src="<?php echo e(asset('assets/admin/img/IBS-Logo.png')); ?>">
                  </div>
                  <div class="card-body">
                  <p class="login-box-msg">Sign in to start your session</p>
                  <?php if(Session::has('message')): ?>
                  <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>        
                  <?php endif; ?>
                      <form action="<?php echo e(route('admin/login.post')); ?>" method="POST">
                          <?php echo csrf_field(); ?>
                          <div class="input-group mb-3">
                            <input type="text" id="email_address" class="form-control" name="email" placeholder="Email" required autofocus>
                            <?php if($errors->has('email')): ?>
                                <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                            <?php endif; ?>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>    
                          </div>
  
                          <div class="input-group mb-3">
                              <div class="input-group mb-3">
                                  <input type="password" id="password" class="form-control" name="password" 
                                  placeholder="Password" required>
                                  <?php if($errors->has('password')): ?>
                                      <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                  <?php endif; ?>
                                          <div class="input-group-append">
                                          <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                          </div>
                                </div>
                              </div>
                          </div>
  
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="icheck-primary">
                                          <input type="checkbox" name="remember" id="remember"> 
                                          <label for="remember">Remember Me
                                          </label>
                                  </div>
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4 mt-4">
                              <button type="submit" class="btn btn-primary">
                                  Login
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layoutlogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>