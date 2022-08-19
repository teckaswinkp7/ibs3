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
                        <form id="msform">
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
                                            <label class="control-label" for="address_line_one_0">Address line 1</label>
                                            <input type="text" id="address_line_one_0" class="form-control" name="Address[0][address_line1]" maxlength="255">
                                            <p class="help-block help-block-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="address_line_two_0">Address line 2</label>
                                            <input type="text" id="address_line_two_0" class="form-control" name="Address[0][address_line2]" maxlength="255">
                                            <p class="help-block help-block-error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="city_0">City</label>
                                            <input type="text" id="city_0" class="form-control" name="Address[0][city]" maxlength="64">
                                            <p class="help-block help-block-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="state_0">State</label>
                                            <select class="form-control select2 select2-init" name="Address[0][state]" id="state_0">
                                                <option>Alabama</option>
                                                <option>Alaska </option>
                                                <option>Arizona </option>
                                                <option>Arkansas </option>
                                                <option>California </option>
                                                <option>Colorado </option>
                                                <option>Connecticut </option>
                                                <option>Delaware </option>
                                                <option>Florida </option>
                                                <option>Georgia </option>
                                                <option>Hawaii </option>
                                                <option>Idaho </option>
                                                <option>Illinois Indiana </option>
                                                <option>Iowa </option>
                                                <option>Kansas </option>
                                                <option>Kentucky </option>
                                                <option>Louisiana </option>
                                                <option>Maine </option>
                                                <option>Maryland </option>
                                                <option>Massachusetts </option>
                                                <option>Michigan </option>
                                                <option>Minnesota </option>
                                                <option>Mississippi </option>
                                                <option>Missouri </option>
                                                <option>Montana Nebraska </option>
                                                <option>Nevada </option>
                                                <option>New Hampshire </option>
                                                <option>New Jersey </option>
                                                <option>New Mexico </option>
                                                <option>New York </option>
                                                <option>North Carolina </option>
                                                <option>North Dakota </option>
                                                <option>Ohio </option>
                                                <option>Oklahoma </option>
                                                <option>Oregon </option>
                                                <option>Pennsylvania Rhode Island </option>
                                                <option>South Carolina </option>
                                                <option>South Dakota </option>
                                                <option>Tennessee </option>
                                                <option>Texas </option>
                                                <option>Utah </option>
                                                <option>Vermont </option>
                                                <option>Virginia </option>
                                                <option>Washington </option>
                                                <option>West Virginia </option>
                                                <option>Wisconsin </option>
                                                <option>Wyoming</option>
                                            </select>
                                            <!--<select id="state_0" class="form-control select2-init" name="Address[0][city]">
                                                <option value="" data-select2-id="2">Select a state ...</option>
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                            </select>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="customer-startdate_0">Start Date</label>
                                            <div class="input-group">
                                                <input type="text" id="customer-startdate_0" class="form-control datepicker-init" name="Address[0][startdate]">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="customer-enddate_0">End Date</label>
                                            <div class="input-group">
                                                <input type="text" id="customer-enddate_0" class="form-control datepicker-init" name="Address[0][enddate]">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
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
                        <a class="btn btn-success btn-sm" id="add-more" href="javascript:;" role="button"><i class="fa fa-plus"></i> Add more address</a>
                    </div>


                </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="next" class="next action-button" value="Next Step"/>
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
@endsection
</body>
</html>   