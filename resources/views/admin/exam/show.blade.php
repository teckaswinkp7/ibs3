@extends('admin.header')  
@section('content')
@include('admin.leftsidebar') 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
                  <li class="breadcrumb-item active">View Exam</li>
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
                <h3 class="card-title">View Exam</h3>
              </div>
               <!-- /.card-header -->
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
                                <label>Exam Name</label>
                                <input type="text" value="{{ $exam->exam_name }}" name="exam_name" id="@if ($errors->has('exam_name')) inputError @endif" class="form-control @if ($errors->has('exam_name')) is-invalid @endif" readonly>
                                @error('exam_name')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Exam Description</label>
                                <textarea class="ckeditor form-control" name="exam_description" placeholder="Exam Description" readonly>
                                {{$exam->exam_description }}
                              </textarea>
                              </div>
                            </div> 
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Course</label>
                                <select name="course_id" id="course_id" class="form-control" disabled>
                                @foreach($course as $key=>$courses)               
                                  <option {{($exam->course_id == $courses->id) ? 'selected' : ''}} value="{{$courses->id}} ">{{ $courses->name }}</option>               
                                @endforeach                                    
                                </select>
                            </div>
                          </div>  
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Document<span class="required">*</span></label>
                              <img src="{{ url('public/Image/'.$exam->exam_document) }}"style="height:50px; width:50px;" class="form-control"  name="document">
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                <label>Exam Duration</label>
                                <input type="text" value="{{ $exam->exam_duration }}" name="exam_duration" id="@if ($errors->has('exam_duration')) inputError @endif" class="form-control @if ($errors->has('exam_duration')) is-invalid @endif" readonly>
                                @error('exam_duration')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div> 
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card-body -->
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