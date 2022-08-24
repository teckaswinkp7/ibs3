@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    @include('front/leftsidebar')
        <div class="col-md-9">
        @if (count($errors) > 0)
                  <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              @foreach($errors->all() as $error)
                              {{ $error }} <br>
                              @endforeach      
                          </div>
                      </div>
                  </div>
                @endif
        <form name="form" id="form" method="post" action="{{route('education.create.step.two.post')}}" enctype="multipart/form-data">
                @csrf
                <div class="alert alert-danger print-error-msg mt-5" style="display:none">
        <ul></ul>
    </div>
                <div class="card mt-5">
                    <div class="card-header">Step 2: Education</div>
                    <div class="card-body" id="dynamic_field">
                            <div class="form-group">
                                <label for="qualification">Qualification<span class="red">*</span></label><br/>
                                <select class="form-control select2 select2-init" name="qualification[]" id="qualification">
                                    <option>Higher School(10th)</option>
                                    <option>Higher School(12th) </option>
                                    <option>Graduation(Bachelors)</option>
                                    <option>Post Graduation(Masters)</option>
                                    <option>Phd </option>
                                </select>  
                            </div>
                            <div class="form-group">
                                <label for="description">Board<span class="red">*</span></label>
                                <input type="text"  value="" class="form-control" name="board[]" id="board"/>
                                
                            </div>
                            <div class="form-group">
                                <label for="description">Percentage<span class="red">*</span></label>
                                <input type="text"  value="" class="form-control" name="percentage[]" id="percentage"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Document Upload<span class="red">*</span></label>
                                <input type="file" class="form-control" name="document[]" id="document"> 
                            </div>  
                            </div>  
                            <div class="card">
                            <div>
                            <a class="btn btn-success btn-sm" id="add" name="add"  role="button"><i class="fa fa-plus"></i> Add more</a>
                            </div>
                            </div> 
                        </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('education.create.step.one') }}" class="btn btn-danger pull-right">Previous</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit"  name="submit" id="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@include('front/footer') 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>    
$(document).ready(function() {
    var i=1;  
    $('#add').click(function(){           
        var qualification = $("#qualification").val();
        i++;  
        $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added"><div class="form-group"><label for="qualification">Qualification<span class="red">*</span></label><br/><select class="form-control select2 select2-init" name="qualification[]"><option>Higher School(10th)</option><option>Higher School(12th)</option><option>Graduation(Bachelors)</option><option>Post Graduation(Masters)</option><option>Phd</option></select></div><div class="form-group"><label for="board">Board<span class="red">*</span></label><input type="text"  value="" class="form-control" name="board[]" /></div><div class="form-group"><label for="description">Percentage<span class="red">*</span></label><input type="text"  value="" class="form-control" name="percentage[]"/></div><div class="form-group"><label for="document">Document Upload<span class="red">*</span></label><input type="file" class="form-control" name="document[]" id="document"></div><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></div>');  
    }); 
});        
$(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
});  
$(document).ready(function () {
    $('#form').validate({ 
        rules: {
            'board[]': {
                required: true
            },
            'percentage[]': {
                required: true
                
            },
            'document[]': {
                required: true,
                extension: "png|jpe?g|pdf", 
                filesize: 1048576
                
            },
        },
        messages: {
            'board[]': {
                required: "This field is required",
            },
            'document[]': {
                inputimage: "File must be JPG, PDF or PNG, less than 1MB",
            }, 
        },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
    });
});
</script>
@endsection
</body>
</html>
