@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add Course</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Add Course</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf    
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Name <span class="required">*</span></label>
                            <input type="text" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Course Name">
                            @error('name')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Slug<span class="required">*</span></label>
                            <input type="text" name="slug" id="@if ($errors->has('slug')) inputError @endif" class="form-control @if ($errors->has('slug')) is-invalid @endif" placeholder="Course Slug">
                            @error('slug')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                          <!-- /.col -->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Course Category</label>
                                <select type="text" name="cat_id" id="cat_id"  class="form-control">
                                    <option value="">None</option>
                                     @foreach($category as $key=>$cat_data)
                                      <option value='{{$cat_data->name}}'>{{$cat_data->name}}</option>
                                     @endforeach
                                </select>
                            </div>
                          </div>
                            <!-- /.form-group -->
                            <div class="col-md-12">
                        <div class="form-group d-none" id="child_cat_div">
                          <label>Select Course SubCategory</label>
                          <select class="browser-default custom-select" name="subcat_id" id="subcat_id">
                          </select>
                        </div>
                      </div>

                      <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Study Period</label>
                                <select type="text" name="study_type" id="study_type"  class="form-control">
                                    <option value="">None</option>
                                     @foreach($studytype as $studtype)
                                      <option value='{{$studtype->title}}'>{{$studtype->title}}</option>
                                     @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Course Image<span class="required">*</span></label>
                              <input type="file" class="form-control"  name="course_image" id="@if ($errors->has('course_image')) inputError @endif" class="form-control @if ($errors->has('course_image')) is-invalid @endif">
                              @error('course_image')
                              <span class="error invalid-feedback d-block">{{ $message }}</span>
                              @enderror  
                            </div>
                          </div>
                          <div class="col-md-12">
                          <div class="form-group">
                            <label>University <span class="required">*</span></label>
                            <select name="university" id="@if ($errors->has('university')) inputError @endif" class="form-control @if ($errors->has('university')) is-invalid @endif" placeholder="Select University">
                            <option>-----</option>  
                            <option name="university" value="IBS college of TVET"> IBS college of TVET </option>
                              <option name="university" value="IBS University"> IBS University </option>
                              <option name="university" value="Southern Cross University"> Southern Cross University </option>
</select>
                            @error('university')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                          <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Start Date<span class="required">*</span></label>
                            <input type="date" name="start_date" id="@if ($errors->has('start_date')) inputError @endif" class="form-control @if ($errors->has('start_date')) is-invalid @endif" placeholder="Start Date">
                            @error('start_date')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                          <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Duration<span class="required">*</span></label>
                            <input type="text" name="course_duration" id="@if ($errors->has('course_duration')) inputError @endif" class="form-control @if ($errors->has('course_duration')) is-invalid @endif" placeholder="Course Duration">
                            @error('course_duration')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Course ID<span class="required">*</span></label>
                            <input type="text" name="course_id" id="@if ($errors->has('course_id')) inputError @endif" class="form-control @if ($errors->has('course_id')) is-invalid @endif" 
                            placeholder="Course ID">
                            @error('course_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Short Description<span class="required">*</span></label>
                              <textarea class="ckeditor form-control" name="short_description" placeholder="Short Description">
                              </textarea>
                               @error('short_description')
                                    <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                @enderror
                            </div>
                          </div>
                            <div class="col-md-12">
                            <div class="form-group">
                              <label>Description<span class="required">*</span></label>
                              <textarea class="ckeditor form-control" name="description" placeholder="Description">
                              </textarea>
                               @error('description')
                                    <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                @enderror
                            </div>
                          </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@include('admin.footer')
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(document).ready(function () {
$('#cat_id').on('change',function(e) {
  alert("hi");
var cat_id = e.target.value;
$.ajax({
url:"{{ route('subcat') }}",
type:"POST",
data: {
cat_id: cat_id
},
success:function (data) {
$('#subcat_id').empty();
 $('#child_cat_div').addClass('d-none');
if(data.subcategories[0].subcategories==""){
  $('#child_cat_div').addClass('d-none');
}
$.each(data.subcategories[0].subcategories,function(index,subcat_id){
$('#child_cat_div').removeClass('d-none');
$('#subcat_id').append('<option value="'+subcat_id.id+'">'+subcat_id.name+'</option>');
})
}
})
});
});
</script>
@endsection
</body>
</html>   