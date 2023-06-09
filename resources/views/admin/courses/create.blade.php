@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary btnreview" href="{{ route('courses.index') }}"> Back</a>
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
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Institute<span class="required">*</span></label>
                                <select type="text" name="institute"  class="form-control">
                                    <option value="">None</option>
                                     @foreach($institute as $inst)
                                      <option value='{{$inst->univ_name}}'>{{$inst->univ_name}}</option>
                                     @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Programme<span class="required">*</span></label>
                                <select type="text" name="prog"  class="form-control">
                                    <option value="">None</option>
                                     @foreach($programme as $prog)
                                      <option value='{{$prog->programme}}'>{{$prog->programme}}</option>
                                     @endforeach
                                </select>
                            </div>
                          </div>
                     
                          <!-- /.col -->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Course Category<span class="required">*</span></label>
                                <select type="text" name="field"   class="form-control">
                                    <option value="">None</option>
                                     @foreach($category as $key=>$cat_data)
                                      <option value='{{$cat_data->name}}'>{{$cat_data->name}}</option>
                                     @endforeach
                                </select>
                            </div>
                          </div>
                      <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Study Period<span class="required">*</span></label>
                                <select type="text" name="study_level"  class="form-control">
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
                            <label>Course Start Date<span class="required">*</span></label>
                            <input type="date" name="start_date" id="@if ($errors->has('start_date')) inputError @endif" class="form-control @if ($errors->has('start_date')) is-invalid @endif" placeholder="Start Date">
                            @error('start_date')
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
                            <label>Course Price <span class="required">*</span></label>
                            <input type="text" name="price" id="@if ($errors->has('price')) inputError @endif" class="form-control @if ($errors->has('price')) is-invalid @endif" 
                            placeholder="Course ID">
                            @error('price')
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
                        <button type="submit" class="btn btn-primary btnreview">Submit</button>
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
<style>
.btnreview{

background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
border:none!important;
}
    </style>
</html>   