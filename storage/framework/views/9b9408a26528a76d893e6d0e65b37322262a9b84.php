  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/profile.css')); ?>">
<style>
*{
   list-style-type: none;
}
</style>
<body>
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="<?php echo e(asset('assets/custom/profile-logo.png')); ?>" alt="" width="100px"></a>
            </div>  
            <h3>Select your Course </h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="userprofile">Profile</a>
                        <a href="useroffer">Course</a>
                        <li ><a href="proformainvoice">Pro-forma-invoice</a></li>
                  <li><a href="proformasalesinvoice">Sales Invoice</a></li>
                  <li ><a href="confirmpayment">Payment</a></li>
                  <li ><a href="history">History</a></li>
                        
                    </div>
                </div>
                <div class="col-sm-9">
                    <p>From the documents you have submitted, you are eligible for the following courses listed below. Kindly make your choice of the course you would like to study at IBS University and receive your offer</p></p>
                    <div class="select-course">
                        <?php 
                        $id = auth::id();
                        $student_course_offer= DB::table('courseselections')->select("courses.name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
                        ?> 
                      <?php
                        $course_list = DB::select( DB::raw("SELECT * FROM courseselections WHERE stu_id = '".Auth::user()->id."'"));
                      ?>
                     
                     <?php
                      $id = auth::id();
                    $offer = DB::table('users')->select('offer_accepted')->where('id',$id)->get();
                    $offeraccepted = $offer[0]->offer_accepted;
                     ?>
                      <?php if($offeraccepted == 'yes'): ?>
                     <span ><a class="badge badge-success">Selected Course : <?php echo e($student_course_offer[0]->name); ?></a> <span>
                     <?php else: ?>
                     <?php if(!empty($course_list)): ?>
                      <?php $__currentLoopData = $course_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                          $course_id = $cl->course_id;
                          $studentSelCid = $cl->studentSelCid;
                          $course_id = str_replace("[","",$course_id);
                          $course_id = str_replace("]","",$course_id);
                          $course_id = str_replace('"','',$course_id);
                          $course_id_arr = explode(",",$course_id);
                        ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php $__currentLoopData = $course_id_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                      $course_name = DB::select(DB::raw("SELECT * FROM courses WHERE id = $val"));
                      ?>
                     <a href="<?php echo e(route('coursestatus',$val)); ?>"><?php echo e($course_name[0]->name); ?></a>
                    
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                     <?php endif; ?>
                     
                 </div>

                </div>
            </div>
            
        </div>
    </div>
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    
    <?php $__env->stopSection(); ?>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/education/course-offer-new.blade.php ENDPATH**/ ?>