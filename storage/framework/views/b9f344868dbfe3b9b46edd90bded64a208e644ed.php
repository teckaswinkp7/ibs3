  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/profile.css')); ?>">
<style>
*{
   list-style-type: none;
}

nav ul li a:hover{
   color:#51be78;
}

 .bill {
   position:static;
   display:block;
}
.bill.show{
   display:block;
}



.bill-show{

   display:none;
}

nav ul li a span{
   position:absolute;
   top:50%;
   right:20px;
   transform:translateY(-50%);
   transition:transform 0.4s;
}

nav ul li a:hover span{

   transform:translateY(-50%) rotate(-180deg);
}

   </style>
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal">
        <div class="profile-logo">
            <a href="#"><img src="<?php echo e(asset('assets/custom/profile-logo.png')); ?>" alt="" width="100px"></a>
        </div>  
        <h3>Your Profile </h3>
        <div class="row">
            <div class="col-sm-3">
                <nav class="profile-course">
                  <ul>

                   <li> <a href="userprofile">Profile</a></li>
                    <li><a href="useroffer">Course</a></li>
                    <li class="bill"><a href="proformainvoice">Pro-forma-invoice</a></li>
                  <li class="bill"><a href="salesinvoice">Sales Invoice</a></li>
                  <li class="bill"><a href="payment">Payment</a></li>
                  <li class="bill"><a href="history">History</a></li>

                    <?php 

                    $id = auth::id();
                    $offeraccepted = DB::table('courseselections')->select('offer_accepted')->where('stu_id',$id)->get();
                    ?> 

                    <?php if($offeraccepted == '1'): ?>
                    <li><a href="history">History</a></li>
                    <?php endif; ?>
                    
                   


                    </ul>
</nav>
            </div>
            <div class="col-sm-9">
                <h6 class="user-credentials">User credentials</h6>
                <?php if(Session::has('message')): ?>
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>        
                    <?php endif; ?>  
                <div class="profile-box">
                    <div class="profile-photo">
                       <img src="<?php echo e(asset('assets/custom/profile-photo.jpg')); ?>" alt="" width="100px">
                       <img src="<?php echo e(asset('assets/custom/edit-icon.jpg')); ?>" alt="" width="18px" height="auto">
                    </div>
                    
                    <div class="profile-details">
                       <div>
                          <label for="">ID</label>
                          <input type="text" value="<?php echo e($allval->college_id); ?>">
                       </div>
                       <div>
                        <label for="">Username</label>
                        <input type="text" value="<?php echo e($val['email']); ?>" style="width: 100%;">
                        <a href="changeuser">(Update)</a>
                     </div>
                     <div>
                        <label for="">Password</label>
                        <input type="text" value="********">
                        <a href="changepassword">(Reset)</a>
                     </div>
                    </div>
                </div>
                <form action="<?php echo e(route('updateprofile')); ?>" class="submission-form" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="stu_id" value="<?php echo e(Auth::id()); ?>">
                <div class="profile-personal-details">
                    <h6 class="user-credentials">Personal Details</h6>
                    <div class="personal-info">
                        <div>
                            <label for="title">Title*</label>                            
                            <input type="text" value="<?php echo e($allval->title); ?>" name="title" required>
                         </div>
                         <div>
                            <label for="">First name*</label>
                            <input type="text" value="<?php echo e($val->first_name); ?>" disabled required>
                         </div>
                         <div>
                            <label for="">Middle name</label>
                            <input type="text" value="<?php echo e($val->mname); ?>" disabled>
                         </div>
                         <div>
                            <label for="">Last name*</label>
                            <input type="text" value="<?php echo e($val->lname); ?>" disabled>
                         </div>
                         <div>
                            <label for="">Date of birth*</label>
                            <input type="date" value="<?php echo e($allval->dob); ?>" name="dob">
                         </div>
                         <div>
                            <label for="">Email*</label>
                            <input type="email" value="<?php echo e($val->email); ?>" disabled>
                         </div>
                         <div>
                            <label for="">Alt. Email</label>
                            <input type="email" value="<?php echo e($allval->alternate_email); ?>" name="alternate_email">
                         </div>
                         <div>
                            <label for="">Phone*</label>
                            <input type="text" value="<?php echo e($val->phone); ?>" name="phone" disabled>
                         </div>
                         <div>
                            <label for="">Alt. Phone</label>
                            <input type="text" name="alternet_phone" value="<?php echo e($allval->alternet_phone); ?>">
                         </div>
                    </div>
                    <h6 class="user-credentials">Background Info</h6>
                    <div class="background-info">
                        <div>
                            <label for="province">Home Province*</label>
                            <input type="text" value="<?php echo e($allval->secondary_school); ?>"  name="secondary_school" >
                         </div>
                         <div>
                            <label for="">Secondary School*</label>
                            <input type="text" value="Hagen Secondary School" required>
                            <input type="year" value="<?php echo e($allval->secondary_school_completed); ?>"  name="secondary_school_completed" >
                         </div>
                         <div> 
                            <label for="">Tertiary Education</label>                      
                              <input type="text" name="tertiary_education" value="<?php echo e($allval->tertiary_education); ?>" placeholder="Name of Institute">
                              <input type="text" name="tertiary_education_year" value="<?php echo e($allval->tertiary_education_year); ?>" placeholder="Year completed">                                                                                  
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" name="tertiary_education_location" value="<?php echo e($allval->tertiary_education_year); ?>" placeholder="Location" >                                                                                                                  
                         </div>
                         <div>
                            <label for="">Other Education</label>
                            <input type="text" placeholder="Name of Institute" value="<?php echo e($allval->other_education); ?>" name="other_education">
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Location" value="<?php echo e($allval->other_education_location); ?>" name="other_education_location">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Current Location</label>
                            <input type="text" placeholder="Location" value="<?php echo e($allval->current_location); ?>" name="current_location">
                            <input type="text" placeholder="Phone" value="<?php echo e($allval->current_address_phone); ?>" name="current_address_phone">  
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Address" value="<?php echo e($allval->current_address_location); ?>" name="current_address_location">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Father’s Contact</label>
                            <input type="text" placeholder="Full name" value="<?php echo e($allval->fathers_name); ?>" name="fathers_name">
                            <input type="text" placeholder="Phone" value="<?php echo e($allval->fathers_contact); ?>"  name="fathers_contact"> 
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Email Address" value="<?php echo e($allval->fathers_email); ?>"  name="fathers_email">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Mother's Contact</label>
                            <input type="text" placeholder="Full name" value="<?php echo e($allval->mothers_name); ?>"  name="mothers_name">
                            <input type="text" placeholder="Phone" value="<?php echo e($allval->mothers_contact); ?>"  name="mothers_contact"> 
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="email" placeholder="Email Address" value="<?php echo e($allval->mothers_email); ?>"  name="mothers_email">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Guardian Contact</label>
                            <input type="text" placeholder="Full name" value="<?php echo e($allval->guardian_name); ?>"  name="guardian_name">
                            <input type="text" placeholder="Phone" value="<?php echo e($allval->guardian_contact); ?>"  name="guardian_contact"> 
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="email" placeholder="Email Address" value="<?php echo e($allval->guardian_email); ?>" name="guardian_email">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Current Employment</label>
                            <input type="text" placeholder="I am currently working at" value="<?php echo e($allval->current_employment); ?>"  name="current_employment">
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Work Address" value="<?php echo e($allval->work_address); ?>"  name="work_address">                                                                                                                  
                         </div>
                    </div>

                    
            <div class="submission row">
            <div class="col-sm-8">
                <p>Documents</p>
                <input type="text" value="<?php echo e($newval[0]->board); ?> Grade 12 Certificate" disabled>
                
            </div>
            <div class="col-sm-4">
                <p>Status</p>
                <?php if($newval[0]->verification_status == 1): ?>
               <input type="text" value="Verified" disabled>
               <?php elseif($newval[0]->verification_status == 2): ?> 
               <input type="text" value="Decline" disabled>   
               <?php else: ?>
               <input type="text" value="Awaiting" disabled>
               <?php endif; ?>
                
                
            </div>
            </div>
            <div class="submission-btn">
                <button type="submit">Save</button>
            </div>
                
                    </form>
                </div>

            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">

$('.bill-btn').click(function(){

   $('.bill').toggleClass("show");

});
   </script>
    
    
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    
    <?php $__env->stopSection(); ?>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/auth/profile.blade.php ENDPATH**/ ?>