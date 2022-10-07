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
                <a class="btn btn-primary" href="{{ route('assignmentgrade.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Assignment Grade</li>
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
                <h3 class="card-title">Assignment Grade</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('assignmentgrade.store') }}" method="GET"  class="mb-0" id="gradeform">
                @csrf  
                    <div class="card-body">
                      <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <input type="hidden" class="form-control" value="{{ $assignmentsub->assignment_id}}"name="assignment_id" readonly>
                            <input type="hidden" class="form-control" value="{{ $assignmentsub->stu_id}}"name="stu_id" readonly>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Student Assignment Description<span class="required">*</span></label>
                            <textarea class="form-control" name="description" readonly>
                              {{ $assignmentsub->assignment_submission_description}}
                            </textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Student Assignment  Document <span class="required">*</span></label>
                            <img src="{{ url('public/Image/'.$assignmentsub->assignment_submission_document) }}"style="height:50px; width:50px;" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Grade Percentage <span class="required">*</span></label>
                            <input type="text" name="assignment_grade_percentage" id="@if ($errors->has('assignment_grade_percentage')) inputError @endif" class="form-control @if ($errors->has('assignment_grade_percentage')) is-invalid @endif" placeholder="Grade Percentage">
                            @error('assignment_grade_percentage')
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