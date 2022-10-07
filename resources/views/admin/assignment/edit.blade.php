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
                <a class="btn btn-primary" href="{{ route('assignment.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update Assignment</li>
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
                <h3 class="card-title">Update Assignment</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('assignment.update',$assignment->id) }}" method="POST" enctype="multipart/form-data"  class="mb-0" id="assignmentform">
               @csrf
                {{ method_field('GET') }}   
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Assignment Title<span class="required">*</span></label>
                                <input type="text" value="{{ $assignment->assignment_title }}" name="assignment_title" id="@if ($errors->has('assignment_title')) inputError @endif" class="form-control @if ($errors->has('assignment_title')) is-invalid @endif" placeholder="Assignment Title">
                                @error('assignment_title')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Assignment Description <span class="required">*</span></label>
                                <textarea class="ckeditor form-control" name="assignment_description" placeholder="Assignment Description">
                                {{$assignment->assignment_description }}
                                </textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                              <label>Assignment Document<span class="required">*</span></label>
                              <img src="{{ url('public/Image/'.$assignment->assignment_document) }}"style="height:50px; width:50px;" class="form-control"  name="document">
                              <input type="file" class="form-control"  name="assignment_document" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Course</label>
                                <select name="course_id" id="course_id" class="form-control">
                                @foreach($course as $key=>$courses)               
                                  <option {{($assignment->course_id == $courses->id) ? 'selected' : ''}} value="{{$courses->id}} ">{{ $courses->name }}</option>               
                                @endforeach                                    
                                </select>
                            </div>
                          </div>  
                          
                          <div class="col-md-12">
                              <div class="form-group">
                                <label>Submitted By</label>
                                <input type="date" value="{{ $assignment->assignment_submission_date }}" name="assignment_submission_date" id="@if ($errors->has('assignment_submission_date')) inputError @endif" class="form-control @if ($errors->has('assignment_submission_date')) is-invalid @endif">
                              </div>
                            </div>
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
@include('admin.footer')
@endsection
</body>
</html>   