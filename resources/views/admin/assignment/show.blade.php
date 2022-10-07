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
                  <li class="breadcrumb-item active">View Assignment</li>
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
                <h3 class="card-title">View Assignment</h3>
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
                                <label>Assignment Title</label>
                                <input type="text" value="{{ $assignment->assignment_title }}" name="assignment_title" id="@if ($errors->has('assignment_title')) inputError @endif" class="form-control @if ($errors->has('assignment_title')) is-invalid @endif" readonly>
                                @error('assignment_title')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div> 
                            
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Assignment Description</label>
                                <textarea class="ckeditor form-control" name="assignment_description" placeholder="Assignment Description" readonly>
                                {{$assignment->assignment_description }}
                              </textarea>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Assignment Submission Date</label>
                                <input type="text" value="{{ $assignment->assignment_submission_date }}" name="assignment_title" id="@if ($errors->has('assignment_title')) inputError @endif" class="form-control @if ($errors->has('assignment_title')) is-invalid @endif" readonly>
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