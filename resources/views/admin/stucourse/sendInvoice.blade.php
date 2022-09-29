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
                <a class="btn btn-primary" href="{{route('studentcourse.invoice')}}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Send Invoice For Course</li>
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
                <h3 class="card-title">Send Invoice For Course</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('studentcourse.storeInvoice') }}" method="POST"  class="mb-0" id="catform" enctype="multipart/form-data">
                @csrf    
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif
                        <div class="row"> 
                        <div class="col-md-12">
                              <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" value="{{$users[0]->name}}" name="stu_name" class="form-control"  readonly>
                                <input type="hidden" value="{{$users[0]->id}}" name="stu_id" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{$users[0]->email}}" name="stu_email" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" value="{{$student_course_invoice[0]->courses_name}}" name="course_offer" class="form-control"  readonly>
                                <input type="hidden" value="{{$student_course_invoice[0]->student_course_id}}" name="offer_course_id" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Custom Price</label>
                                <input type="text"  name="custom_price" class="form-control">                               
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Invoice Details (Email Body)</label>
                                <textarea class="form-control" rows="8" name="course_offer_description" id="course_offer_description"></textarea>
                              </div>
                            </div> 
                            {{-- <div class="col-md-12">
                              <div class="form-group">
                                <label>Attachment</label>
                                <input type="file" class="form-control" rows="8" name="attachment" id="attachment"></textarea>
                              </div>
                            </div>                             --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- <a href="{{route('generate.invoice',$users[0]->id)}}" class="btn btn-info">Generate Invoice</a> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- <div class="card-footer">
                       
                    </div> -->
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