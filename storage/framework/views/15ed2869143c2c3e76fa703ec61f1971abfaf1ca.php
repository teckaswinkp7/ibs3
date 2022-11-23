  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<!-- For validations -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/
    4.0.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/
    jquery/3.3.1/jquery.min.js">
    </script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/
    popper.js/1.12.9/umd/popper.min.js">
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/
    4.0.0/js/bootstrap.min.js">
    </script>
<!-- Ends For validations -->
<div class="background-register" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="<?php echo e(asset('assets/custom/New Project (14).png')); ?>" alt="" width="120px"></a>
            </div>  
            <h3>Create your account</h3>
            <form action="<?php echo e(route('register.final')); ?>" method="POST" class="register-form">
                <?php echo csrf_field(); ?>
               
                    
                    <input type="hidden" id="user_role" name="user_role" value="2">
                        
                <div>
                    <label for="">Password</label>
                    <input type="password" placeholder="" id="password" name="password" required>
                    <?php if($errors->has('password')): ?>
                        <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                    <?php endif; ?>

                   
                </div>
                <div>
                    <label for="">Confirm Password</label>
                    <input type="password" placeholder="" id="conpassword" name="confirm_password" required>
                    <?php if($errors->has('confirm_password')): ?>
                        <span class="text-danger"><?php echo e($errors->first('confirm_password')); ?></span>
                    <?php endif; ?>

                    

                </div>
                <div class="register-btn">
                    <button type="submit">Register</button>
                </div>
            
          </form>
        </div>
    </div>
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    <script>
        // Document is ready
        $(document).ready(function () {
        // Validate Username
        $("#usercheck").hide();
        let usernameError = true;
        $("#usernames").keyup(function () {
            validateUsername();
        });
        
        function validateUsername() {
            let usernameValue = $("#usernames").val();
            if (usernameValue.length == "") {
            $("#usercheck").show();
            usernameError = false;
            return false;
            } else if (usernameValue.length < 3 || usernameValue.length > 10) {
            $("#usercheck").show();
            $("#usercheck").html("**length of username must be between 3 and 10");
            usernameError = false;
            return false;
            } else {
            $("#usercheck").hide();
            }
        }
        
        // Validate Email
        const email = document.getElementById("email");
        email.addEventListener("blur", () => {
            let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
            let s = email.value;
            if (regex.test(s)) {
            email.classList.remove("is-invalid");
            emailError = true;
            } else {
            email.classList.add("is-invalid");
            emailError = false;
            }
        });
        
        // Validate Password
        $("#passcheck").hide();
        let passwordError = true;
        $("#password").keyup(function () {
            validatePassword();
        });
        function validatePassword() {
            let passwordValue = $("#password").val();
            if (passwordValue.length == "") {
            $("#passcheck").show();
            passwordError = false;
            return false;
            }
            if (passwordValue.length < 3 || passwordValue.length > 10) {
            $("#passcheck").show();
            $("#passcheck").html(
                "**length of your password must be between 3 and 10"
            );
            $("#passcheck").css("color", "red");
            passwordError = false;
            return false;
            } else {
            $("#passcheck").hide();
            }
        }
        
        // Validate Confirm Password
        $("#conpasscheck").hide();
        let confirmPasswordError = true;
        $("#conpassword").keyup(function () {
            validateConfirmPassword();
        });
        function validateConfirmPassword() {
            let confirmPasswordValue = $("#conpassword").val();
            let passwordValue = $("#password").val();
            if (passwordValue != confirmPasswordValue) {
            $("#conpasscheck").show();
            $("#conpasscheck").html("**Password didn't Match");
            $("#conpasscheck").css("color", "red");
            confirmPasswordError = false;
            return false;
            } else {
            $("#conpasscheck").hide();
            }
        }
        
        // Submit button
        $("#submitbtn").click(function () {
            //validateUsername();
            validatePassword();
            validateConfirmPassword();
            //validateEmail();
            if (
            
            passwordError == true &&
            confirmPasswordError == true
            ) {
            return true;
            } else {
            return false;
            }
        });
        });
    </script>
    <?php $__env->stopSection(); ?>   
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/auth/set_passworddds.blade.php ENDPATH**/ ?>