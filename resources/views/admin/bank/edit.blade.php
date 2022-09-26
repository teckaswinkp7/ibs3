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
                <a class="btn btn-primary" href="{{ route('bank.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update Bank Details</li>
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
                <h3 class="card-title">Update Bank Details</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('bank.update',$bankdetails->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
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
                                <label>IFSC Code <span class="required">*</span></label>
                                <input type="text" value="{{ $bankdetails->ifsc_code }}" name="ifsc_code"   class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Category Name">
                                
                              </div>
                            </div> 
                            
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Bank Name <span class="required">*</span></label>
                                <input type="text" value="{{ $bankdetails->bank_name }}" name="bank_name"  class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Category Name">                                
                              </div>
                            </div> 

                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Account Number <span class="required">*</span></label>
                                <input type="text" value="{{ $bankdetails->account_number }}" name="account_number"   class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Category Name">
                                
                              </div>
                            </div> 

                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Account Holder Name <span class="required">*</span></label>
                                <input type="text" value="{{ $bankdetails->account_holder_name }}" name="account_holder_name"   class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Category Name">
                               
                              </div>
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
@include('admin.footer')
@endsection
</body>
</html>   