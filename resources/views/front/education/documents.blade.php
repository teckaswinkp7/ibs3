@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  


<!-- DATA VALIDATION -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
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
                <p>I want to apply for the following Institute ?</p>
                <div class="radio-documents row">
                <div class="col-sm-12">
                    <label>IBS college of TVET</label>
                    <input type="radio" name="university" value="IBS college of TVET">
                   
                </div>
                <div class="col-sm-12">
                     <label>IBSUniversity</label>
                    <input type="radio" name="university" value="IBSUniversity">
                    
                </div>
                <div class="col-sm-12">
                    
                    <label>Southern Cross University(Australia)</label>
                    <input type="radio" name="university" value="Southern Cross University">
                </div>
                
                </div>
                <p>I would like to take: </p>
                <div class="radio-documents row">
                <div class="col-sm-6">
                    <label>Accounting and Finance</label>
                    <input type="radio" name="field" value="Accounting and Finance">
                   
                </div>
                <div class="col-sm-6">
                     <label>Economics & Development</label>
                    <input type="radio" name="field" value="Economics & Development">
                    
                </div>
                <div class="col-sm-6">
                    
                    <label>Business and Management</label>
                    <input type="radio" name="field" value="Business and Management">
                </div>
                <div class="col-sm-6">
                    
                    <label>Information Technology</label>
                    <input type="radio" name="field" value="Information Technology">
                </div>
                
                </div>
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
                    <label>Diploma / Bachelor</label>
                </div>
                
                <div class="col-sm-12">
                    <input type="radio" name="qualification" value="Grade 12th Student">
                    <label>I'm a Grade 12th Student</label>
                </div>
                </div>
                

                {{-- <input type="email" name="email" id="email" class="form-control" placeholder="Email" data-val-required="Please fill up the details" data-val="true">
                  <span data-valmsg-for="email" class="field-validation-valid text-danger" data-valmsg-replace="true"></span>  --}}
                <div class="card">
                <div class="upload-ps">
                    <div class="custom-file">
      <input type="file" name="id_image" class="custom-file-input" id="customFileInput1" aria-describedby="customFileInput">
      <label class="custom-file-label" id="inputGroupFile02" for="customFileInput"> Upload Your Passport Size ID image.</label>
      <span data-valmsg-for="id_image" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
    </div>
    </div>
    </div>
                </br>    
                <div class="upload-ps">
                <div class="custom-file">
      <input type="file" name="highest_qualification" class="custom-file-input" id="customFileInput2" aria-describedby="customFileInput">
      <label class="custom-file-label" id="inputGroupFile03" for="customFileInput"> Upload your highest qualification.</label>
      <span data-valmsg-for="highest_qualification" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
    </div>
    </div>
                </br>
                <div class="upload-ps">
                <div class="custom-file">
      <input type="file" name="course_syopsiy" class="custom-file-input" id="customFileInput3" aria-describedby="customFileInput">
      <label class="custom-file-label" id="inputGroupFile04" for="customFileInput"> Upload Transcripts or Course Synopsis.</label>
      <span data-valmsg-for="course_syopsiy" class="field-validation-valid text-danger" data-valmsg-replace="true"></span> 
    </div>
    </div>
        
                   <div class="documents-btn">
                    <button type="submit">Submit</button>
                </div>
          </form>
        </div>
    </div>
    @include('front/footer') 
    <script>
         $('#customFileInput1').change(function(e){
        var fileName = e.target.files[0].name;
        $('#inputGroupFile02').html(fileName);
    });

    
    </script>
<script>
$('#customFileInput2').change(function(e){
        var fileName = e.target.files[0].name;
        $('#inputGroupFile03').html(fileName);
    });
</script>


<script>
    $('#customFileInput3').change(function(e){
        var fileName = e.target.files[0].name;
        $('#inputGroupFile04').html(fileName);
    });
    </script>

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
    <style>
        .custom-file-label::after{

            background:#cc6600;
            color:white;
            
        }

        .custom-file-input:lang(en) ~ .custom-file-label::after
        {
            content:"Select";
        }

        </style>
    @endsection  