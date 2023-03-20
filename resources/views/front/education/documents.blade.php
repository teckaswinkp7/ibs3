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

<style>
.hide {
  display: none;
}

</style>

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
    <div class="form-check">
  <input onclick="show1();" class="form-check-input" type="radio" value="IBS college of TVET" name="university" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  IBS college of TVET
  </label>
</div>
<div class="form-check">
  <input onclick="show2();" class="form-check-input" type="radio" value="IBSUniversity" name="university" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  IBSUniversity
  </label>
</div>
<div class="form-check">
  <input onclick="show3();" class="form-check-input" type="radio" value="Southern Cross University" name="university" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  Southern Cross University(Australia)
  </label>
</div>
</div>
                
<!---- Div 1   start    !-->
                <div class="row hide" id="div1" style="margin-left:10px;">
                <p>I would like to take: </p>

                <div class="row">
                <div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="field" value="Accounting and Finance" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  Accounting and Finance
  </label>
</div>
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="field" value="Business and Management" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault2">
  Business and Management
  </label>
</div>
</div>
<div class="row">
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="field" value="Economic and Development studies" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault2">
  Economic and Development studies
  </label>
</div>
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="field" value="Information Technology" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault2">
  Information Technology
  </label>
</div>
</div>
                
</div>

<!---- Div 1   End    !-->


<!---- Div 2   start    !-->

<div class="row hide" id="div2" style="margin-left:10px;">
<p>I would like to take: </p>
<div class="row">
<div class="form-check col-sm-4">
<input class="form-check-input" type="radio" name="field" value="Accounting" id="flexRadioDefault1">
<label class="form-check-label" for="flexRadioDefault1">
Accounting
</label>
</div>
<div class="form-check col-sm-4">
<input class="form-check-input" type="radio" name="field" value="Business" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
Business
</label>
</div>
<div class="form-check col-sm-4">
<input class="form-check-input" type="radio" name="field" value="Economics" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
Economics
</label>
</div>
</div>
<div class="row">

<div class="form-check col-sm-6">
<input class="form-check-input" type="radio" name="field" value="Information Technology" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
Information Technology
</label>
</div>
<div class="form-check col-sm-6">
<input class="form-check-input" type="radio" name="field" value="Human Resources" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
Human</br>Resources
</label>
</div>
</div>


</div>

<!---- Div 2   End     !-->

<!---- Div 3   start    !-->

<div class="row hide" id="div3" style="margin-left:10px;">
<p>I would like to take: </p>
<div class="form-check col-sm-6">
<input class="form-check-input" type="radio" name="field" value="Accounting" id="flexRadioDefault1">
<label class="form-check-label" for="flexRadioDefault1">
Accounting
</label>
</div>
<div class="form-check col-sm-6">
<input class="form-check-input" type="radio" name="field" value="Management" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
Management
</label>
</div>
<div class="form-check col-sm-6">
<input class="form-check-input" type="radio" name="field" value="Information Technology" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
Information Technology
</label>
</div>
</div>




<!---- Div 3   End    !-->
</br>

                <p>Which is your highest qualification?</p>
                <div class="radio-documents row">

                <div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="qualification" value="Grade 10" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  Grade 10
  </label>
</div>  
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="qualification" value="Certificate 3 or 4" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  Certificate 3 or 4
  </label>
</div>  
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="qualification" value="Grade 12" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  Grade 12
  </label>
</div>  
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="qualification" value="Diploma / Bachelor" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  Diploma / Bachelor
  </label>
</div>  
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="qualification" value="Grade 12th Student" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  I'm a Grade 12th Student
  </label>
</div>  
</div>

    <p> I have also upgraded my marks from FODE/DODL etc. </p>
    <div class="row">
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="fodl" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Yes
  </label>
</div>
<div class="form-check col-sm-6">
  <input class="form-check-input" type="radio" name="fodl" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
    No
  </label>
</div>
</div>
               
</br>             

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
                    <button type="submit">Screen Documents</button>
                </div>
          </form>
        </div>
    </div>
    @include('front/footer') 
    <script>
    function show1(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='block';
  document.getElementById('div3').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
}
function show3(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='block';
}

</script>
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