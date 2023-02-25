@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  


<!-- DATA VALIDATION -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"> </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.6/jquery.validate.unobtrusive.min.js"></script> 
<!-- DATA VALIDATION ENDS -->

    <div class="background-documents" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="{{asset('assets/custom/New Project (14).png')}}" alt="" width="120px"></a>
            </div>  
            <h3>Submit your documents</h3>
            <form action="{{route('education.create.step.two.post')}}" method="POST" enctype="multipart/form-data" class="document-form">
                @csrf
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
                

                {{-- <input type="email" name="email" id="email" class="form-control" placeholder="Email" data-val-required="Please fill up the details" data-val="true">
                  <span data-valmsg-for="email" class="field-validation-valid text-danger" data-valmsg-replace="true"></span>  --}}
                <div class="upload-ps">
                    <label>Upload your passport size ID image.(upload pdf png or jpeg format)</label>
                    <input style="display:block" type="file" id="my-file" name="id_image" data-val-required="Please fill up the details" data-val="true">
                    {{-- <button type="button" onclick="document.getElementById('my-file').click()">Upload your passport size ID image</button> --}}
                    <span data-valmsg-for="id_image" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
                </div>
                <div class="upload-ps">
                    <label>Upload your highest qualification</label>
                    <input style="display:block" type="file" id="my-file-hq" name="highest_qualification" data-val-required="Please fill up the details" data-val="true">
                    {{-- <button type="button" onclick="document.getElementById('my-file-hq').click()">Upload your highest qualification</button> --}}
                    <span data-valmsg-for="highest_qualification" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
                </div>
                <div class="upload-ps">
                    <label>Upload Transcripts or Course Synopsis</label>
                    <input style="display:block" type="file" id="my-file-toc" name="course_syopsiy" data-val-required="Please fill up the details" data-val="true">
                    {{-- <button type="button" onclick="document.getElementById('my-file-toc').click()">Upload Transcripts or Course Synopsis ( for qualification higher than Grade 12)</button> --}}
                    <span data-valmsg-for="course_syopsiy" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
                </div>
                
                    
                
                <div class="documents-btn">
                    <button type="submit">Submit</button>
                </div>
          </form>
        </div>
    </div>
    @include('front/footer')  

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
    @endsection  