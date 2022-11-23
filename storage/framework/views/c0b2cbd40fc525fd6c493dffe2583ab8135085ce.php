  
<?php $__env->startSection('content'); ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(asset('assets/custom/common.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  


<!-- DATA VALIDATION -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"> </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.6/jquery.validate.unobtrusive.min.js"></script> 
<!-- DATA VALIDATION ENDS -->

    <div class="background-documents" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="<?php echo e(asset('assets/custom/New Project (14).png')); ?>" alt="" width="120px"></a>
            </div>  
            <h3>Submit your documents</h3>
            <form action="<?php echo e(route('education.create.step.two.post')); ?>" method="POST" enctype="multipart/form-data" class="document-form">
                <?php echo csrf_field(); ?>
                <p>Which is your highest qualification?</p>
                <div class="radio-documents row">
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="Grade 10">
                    <label>Grade 10</label>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="Certificate 3 or 4">
                    <label>Certificate 3 or 4</label>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="12th">
                    <label>Grade 12</label>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="Diploma / Bachelor">
                    <label>Certificate 3 or 4</label>
                </div>
                
                <div class="col-sm-12">
                    <input type="radio" name="qualification" value="Grade 12th Student">
                    <label>I'm a Grade 12th Student</label>
                </div>
                </div>
                

                
                <div class="upload-ps">
                    <label>Upload your passport size ID image</label>
                    <input style="display:block" type="file" id="my-file" name="id_image" data-val-required="Please fill up the details" data-val="true">
                    
                    <span data-valmsg-for="id_image" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
                </div>
                <div class="upload-ps">
                    <label>Upload your highest qualification</label>
                    <input style="display:block" type="file" id="my-file-hq" name="highest_qualification" data-val-required="Please fill up the details" data-val="true">
                    
                    <span data-valmsg-for="highest_qualification" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
                </div>
                <div class="upload-ps">
                    <label>Upload Transcripts or Course Synopsis</label>
                    <input style="display:block" type="file" id="my-file-toc" name="course_syopsiy" data-val-required="Please fill up the details" data-val="true">
                    
                    <span data-valmsg-for="course_syopsiy" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
                </div>
                
                    
                
                <div class="documents-btn">
                    <button type="submit">Submit</button>
                </div>
          </form>
        </div>
    </div>
    <?php echo $__env->make('front/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    <script>
        function fileValidation() {
            var fileInput =
                document.getElementById('my-file');
                
             
            var filePath = fileInput.value;
         
            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)|\.pdf)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            }
            else
            {
             
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'imagePreview').innerHTML =
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                     
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>
    <?php $__env->stopSection(); ?>  
<?php echo $__env->make('front/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ibs\resources\views/front/education/documents.blade.php ENDPATH**/ ?>