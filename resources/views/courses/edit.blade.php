@extends('header')  
@section('content')
@include('leftsidebar') 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
                  <li class="breadcrumb-item active">Update Course</li>
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
                <h3 class="card-title">Update Course</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('courses.update',$course->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf
                {{ method_field('PUT') }}    
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Course Name <span class="required">*</span></label>
                                <input type="text" value="{{ $course->name }}" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Category Name">
                                @error('name')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>  
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Course Slug<span class="required">*</span></label>
                                <input type="text" value="{{ $course->slug }}" name="slug" id="@if ($errors->has('slug')) inputError @endif" class="form-control @if ($errors->has('slug')) is-invalid @endif" placeholder="Category Slug">
                                @error('slug')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                 @enderror
                              </div>
                            </div>
                              <!-- /.col -->
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Select Parent Course</label>
                                   <select name="cat_id" id="cat_id" class="form-control">
                @foreach($category as $key=>$cat_data)
                @foreach ($course->category as $cat)
                @if($cat_data->id==$cat->id)
                <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                @else
                <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                @endif  
                @endforeach
                 @endforeach
                </select>
                                </div>
                              </div>  
                                <!-- /.form-group -->
                                <div class="col-md-12">
               @if($course->subcat_id==NULL)                   
                <div class="form-group d-none" id="child_cat_div">
                @else
                <div class="form-group" id="child_cat_div">
                @endif   
                <label>SubCategories</label>
                <select class="browser-default custom-select" name="subcat_id" id="subcat_id">
                @foreach ($course->subcategory as $subcat)
                <option value='{{$subcat->id}}'>{{$subcat->name}}</option>
                @endforeach
                </select>
              </div>
            </div>
                                 <div class="col-md-12">
                            <div class="form-group">
                              <label>Course Image<span class="required">*</span></label>
                              <img src="{{ url('public/Image/'.$course->course_image) }}"style="height:50px; width:50px;" class="form-control"  name="product_image">
                              <input type="file" class="form-control"  name="course_image" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-12">
                          <div class="form-group">
                            <label>Course Duration<span class="required">*</span></label>
                            <input type="text" name="course_duration" value="{{$course->course_duration }}" id="@if ($errors->has('course_duration')) inputError @endif" class="form-control @if ($errors->has('course_duration')) is-invalid @endif" placeholder="Course Duration">
                            @error('course_duration')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Course ID<span class="required">*</span></label>
                            <input type="text" name="course_id" value="{{ $course->course_id }}" id="@if ($errors->has('course_id')) inputError @endif" class="form-control @if ($errors->has('course_id')) is-invalid @endif" 
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
                                {{ $course->short_description }}
                              </textarea>
                               @error('short_description')
                                    <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                @enderror
                            </div>
                          </div>
                              <div class="col-md-12">  
                                <div class="form-group">
                                  <label>Description<span class="required">*</span></label>
                                  <textarea class="ckeditor form-control" name="description" placeholder="Description">{{ $course->description }}
                                  </textarea>
                                   @error('description')
                                        <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                    @enderror
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
                        <button type="submit" class="btn btn-primary">Update</button>
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
@include('footer')
<script type="text/javascript">
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$(document).ready(function () {
$('#cat_id').on('change',function(e) {
var cat_id = e.target.value;
$.ajax({
url:"{{ route('subcat') }}",
type:"POST",
data: {
cat_id: cat_id
},
success:function (data) {
if(data.subcategories[0].subcategories==""){
$('#child_cat_div').addClass('d-none');
}  
$('#subcat_id').empty();
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