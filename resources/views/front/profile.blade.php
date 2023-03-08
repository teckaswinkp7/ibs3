@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
<div class="row justify-content-center"> 
 @include('front/leftsidebar')   
            <div class="col-md-9">
                <div class="card custom-margin">
                    <div class="card-body pt-0">
                        <div class="row mt-0">
                            <div class="col-md-12">
                            <h4>Update Profile</h4>
                            <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mx-0">
                                        <form id="msform" action="{{ url('edit-profile') }}" method="Post">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active" id="account"><strong>Personal</strong></li>
                                                <li id="personal"><strong>Educational</strong></li>
                                                <li id="confirm"><strong>Finish</strong></li>
                                            </ul>
                                            <!-- fieldsets -->
                                            <fieldset>
                                                <div class="form-card">
                                                    <h2 class="fs-title">Personal Information</h2>
                                                    <input type="text" name="fname" placeholder="Name"/>
                                                    <input type="text" name="lname" placeholder="Email Id"/>
                                                    <input type="text" name="phno" placeholder="Contact No"/>
                                                </div>
                                                <input type="button" name="next" class="next action-button" value="Next Step"/>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <h2 class="fs-title">Educational Qualification</h2>
                                                    <div id="main-container">
                                                        <div class="panel card container-item">
                                                            <div class="panel-body">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="Qualification_0">Qualification</label>
                                                                                <select class="form-control select2 select2-init" name="Education[0][qualification]" id="qualification_0">
                                                                                <option>Higher School(10th)</option>
                                                                                <option>Higher School(12th) </option>
                                                                                <option>Graduation(Bachelors)</option>
                                                                                <option>Post Graduation(Masters)</option>
                                                                                <option>Phd </option>
                                                                                </select>                                
                                                                                <p class="help-block help-block-error"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="board_0">Board</label>
                                                                                <input type="text" id="board_0" class="form-control" name="Education[0][board]">
                                                                                <p class="help-block help-block-error"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="percentage_0">Percentage</label>
                                                                                <input type="text" id="percentage_0" class="form-control" name="Education[0][percentage]">
                                                                                <p class="help-block help-block-error"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="document_0">Document Upload</label>
                                                                                <input type="file" id="document_0" class="form-control" name="Education[0][document]">
                                                                                <p class="help-block help-block-error"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div>
                                                                            <a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                    <div>
                                                    <a class="btn btn-success btn-sm" id="add-more" href="javascript:;" role="button"><i class="fa fa-plus"></i> Add more</a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                                <input type="submit" name="next" class="next action-button" value="Next Step"/>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                  <h2 class="fs-title text-center">Success !</h2>
                                                  <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-3">
                                                        <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                   <div class="row justify-content-center">
                                                        <div class="col-7 text-center">
                                                        <h5>You Have Successfully Signed Up</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front/footer')  
<script type="text/javascript" >
   var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

 </script> 
@endsection
</body>
</html>   