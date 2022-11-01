@extends('admin.header')  
@section('content')
@include('admin.leftsidebar') 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{route('admin.units.index')}}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active"> Add Unit  </li>
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
                <h3 class="card-title">Add Unit </h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('admin.units.store') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf  
                
                <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">

                <label for="course_id">Course*</label>
                    <select name="course_id" class="form-control" id="course_id" >
                        @foreach($courses as $id => $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    </div>
                        </div>
</div>
</div>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Unit Name </label>
                            <input type="text" name="title" id="@if ($errors->has('title')) inputError @endif" class="form-control @if ($errors->has('title')) is-invalid @endif " placeholder="Unit Name">
                            @error('title')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>
<div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Slug </label>
                            <input type="text" name="slug" id ="@if ($errors->has('slug')) inputError @endif" class="form-control @if ($errors->has('slug')) is-invalid @endif" placeholder="slug">
                             @error('slug')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>

                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Video Url </label>
                            <input type="text" name="embeded_id" id ="@if ($errors->has('embeded_id')) inputError @endif" class="form-control @if ($errors->has('embeded_id')) is-invalid @endif" placeholder="Video Url">
                             @error('embeded_id')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>


                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Short Description </label>
                            <input type="text" name="short_text"  id ="@if ($errors->has('short_text')) inputError @endif" class="form-control @if ($errors->has('short_text')) is-invalid @endif" placeholder="Short Description">
                             @error('short_text')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>
                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Description </label>
                            <input type="text" name="full_text" id ="@if ($errors->has('full_text')) inputError @endif" class="ckeditor form-control @if ($errors->has('full_text')) is-invalid @endif" placeholder=" Description ">
                             @error('full_text')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Unit Price</label>
                            <input class="form-control" name="unit_price" type="number" placeholder="Unit Price"> 
    
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status" >Status </label>
                            <select class="form-control" required name="published">
                            <option value="1">
                                Enabled
</option>
<option value="0"> 
  Disabled
</option>
</select>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                
                </div>
                        </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@include('admin.footer')
@endsection
</body>
</html>   