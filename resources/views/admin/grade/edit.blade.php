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
                <a class="btn btn-primary" href="{{ route('grade.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update Grade</li>
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
                <h3 class="card-title">Update Grade</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('grade.update',$grades->id) }}" method="POST"  class="mb-0" id="gradeform">
                @csrf
                {{ method_field('POST') }}    
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Grade Name <span class="required">*</span></label>
                                <input type="text" value="{{ $grades->grade_name }}" name="grade_name" id="@if ($errors->has('grade_name')) inputError @endif" class="form-control @if ($errors->has('grade_name')) is-invalid @endif" placeholder="Grade Name">
                                @error('grade_name')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Grade Min Percentage <span class="required">*</span></label>
                                <input type="text" value="{{ $grades->grade_min_percentage }}" name="grade_min_percentage" id="@if ($errors->has('grade_min_percentage')) inputError @endif" class="form-control @if ($errors->has('grade_min_percentage')) is-invalid @endif" placeholder="Grade Min Percentage">
                                @error('grade_min_percentage')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Grade Max Percentage <span class="required">*</span></label>
                                <input type="text" value="{{ $grades->grade_max_percentage }}" name="grade_max_percentage" id="@if ($errors->has('grade_max_percentage')) inputError @endif" class="form-control @if ($errors->has('grade_max_percentage')) is-invalid @endif" placeholder="Grade Max Percentage">
                                @error('grade_max_percentage')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
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