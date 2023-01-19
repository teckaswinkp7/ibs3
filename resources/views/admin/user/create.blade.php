@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add User</li>
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
                <h3 class="card-title">Add User</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf    
                    <div class="card-body">
                      <div class="row">
                        <!-- <div class="col-md-12">
                          <div class="form-group">
                            <label>User Id<span class="required">*</span></label>
                            <input type="text" name="uid" id="@if ($errors->has('uid')) inputError @endif" class="form-control @if ($errors->has('uid')) is-invalid @endif" placeholder="User Id">
                            @error('uid')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div> -->
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Name<span class="required">*</span></label>
                            <input type="text" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Name">
                            @error('name')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Select User Role<span class="required">*</span></label>
                                <select type="text" name="user_role" id="user_role"  class="form-control">
                                    <option value="">None</option>
                                     @foreach($urole as $key=>$role_data)
                                      <option value='{{$role_data->id}}'>{{$role_data->name}}</option>
                                     @endforeach
                                </select>
                              @error('user_role')
                              <span class="error invalid-feedback" style="color:#dc3545;display:block !important;">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Email<span class="required">*</span></label>
                            <input type="text" name="email" id="@if ($errors->has('email')) inputError @endif" class="form-control @if ($errors->has('email')) is-invalid @endif" placeholder="Email">
                            @error('email')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Phone<span class="required">*</span></label>
                            <input type="text" name="phone" id="@if ($errors->has('phone')) inputError @endif" class="form-control @if ($errors->has('phone')) is-invalid @endif" placeholder="Phone">
                            @error('phone')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Password<span class="required">*</span></label>
                            <input type="password" name="password" id="@if ($errors->has('password')) inputError @endif" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="Password">
                            @error('password')
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