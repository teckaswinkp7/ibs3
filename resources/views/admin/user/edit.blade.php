@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
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
                <h3 class="card-title">Update User</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">  
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
                                <label>User Id</label>
                                <input type="text" value="{{ $user->uid }}" name="uid" id="@if ($errors->has('uid')) inputError @endif" class="form-control @if ($errors->has('uid')) is-invalid @endif" placeholder="User Id">
                            @error('uid')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                              </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>User Role</label>
                                   <select name="user_role" id="user_role" class="form-control">
                                    @foreach($role as $key=>$cat_data)
                                    @foreach ($user->role as $cat)
                                    @if($cat_data->id==$cat->id)
                                    <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                                    @else
                                    <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                                    @endif  
                                    @endforeach
                                    @endforeach
                                    </select>
                                </div>
                              </div>  
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text"  value="{{ $user->email }}" name="email" id="@if ($errors->has('email')) inputError @endif" class="form-control @if ($errors->has('email')) is-invalid @endif" placeholder="Email" readonly>
                            @error('email')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" value="{{ $user->password }}" name="password" class="form-control" readonly>
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