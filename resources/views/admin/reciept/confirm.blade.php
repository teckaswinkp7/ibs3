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
                <a class="btn btn-primary" href="{{route('reciept.index')}}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update User</li>
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
                <h3 class="card-title">Confirm Reciept</h3>
              </div>
               <!-- /.card-header -->
               
                <form action="{{route('confirm.store')}}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
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
                                <label>Name</label>
                                <input type="text" value="{{ $user[0]->name }}" name="name" class="form-control"  readonly>
                                <input type="hidden" value="{{ $user[0]->id }}" name="stu_id" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ $user[0]->email }}" name="email" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="{{ $user[0]->phone }}" name="phone" class="form-control"  readonly>
                              </div>
                            </div> 
                            <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th> Sales Invoice</th>
                  <th>Payment Reciept</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  @foreach ($reciepts as $reciept)
                  
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td> Download </td>
                <td><a href="{{url('payreciept')}}/{{ $reciept->payreciept }}" target="_blank"><img src="{{url('public/uploads/pdf_icon.png')}}" style="width:100px;height:100px;"></a></td>
                    </tr> 
                  @endforeach
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                </table>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Payment Confirmed </label>
                    <div class="form-check">
                    <label class="form-check-label" for="radio1">
                    <input type="radio" class="form-check-input" id="status" name="status" value="Partially paid"> Partially paid
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio2">
                    <input type="radio" class="form-check-input" id="status" name="status" value="Fully Paid"> Fully Paid
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio2">
                    <input type="radio" class="form-check-input" id="status" name="status" value="waiting Reconcillation"> Not Valid Reciept
                    </label>
                    </div>
                  </div>
                  </div> 
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