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
                <a class="btn btn-primary" href="{{ route('exam.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add Exam</li>
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
                <h3 class="card-title">Add Exam</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('exam.store') }}" method="POST"   enctype="multipart/form-data" class="mb-0" id="examform">
                @csrf  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Exam Name <span class="required">*</span></label>
                            <input type="text" name="exam_name" id="@if ($errors->has('exam_name')) inputError @endif" class="form-control @if ($errors->has('exam_name')) is-invalid @endif" placeholder="Exam Name">
                            @error('exam_name')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Exam Description<span class="required">*</span></label>
                            <textarea class="ckeditor form-control" name="exam_description" placeholder="Exam Description"></textarea>
                              @error('exam_description')
                                <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                              @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Select Course<span class="required">*</span></label>
                            <select name="course_id" id="course_id @if ($errors->has('course_id')) inputError @endif" class="form-control @if ($errors->has('assignment_title')) is-invalid @endif">
                              <option value="">None</option>
                              @foreach($course as $key=>$courses)
                              <option value='{{ $courses->id }}'>{{ $courses->name }}</option>
                              @endforeach
                            </select>
                            @error('course_id')
                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>File Upload<span class="required">*</span></label>
                            <input type="file" class="form-control"  name="exam_document" id="@if ($errors->has('exam_document')) inputError @endif" class="form-control @if ($errors->has('exam_document')) is-invalid @endif">
                              @error('exam_document')
                              <span class="error invalid-feedback d-block">{{ $message }}</span>
                              @enderror  
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Exam Duration <span class="required">*</span></label>
                            <input type="text" name="exam_duration" id="@if ($errors->has('exam_duration')) inputError @endif" class="form-control @if ($errors->has('exam_duration')) is-invalid @endif" placeholder="Exam Duration">
                            @error('exam_duration')
                              <span class="error invalid-feedback">{{ $message }}</span>
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
@endsection
</body>
</html>   