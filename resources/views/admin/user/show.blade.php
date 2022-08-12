@extends('admin/header')  
@section('content')
@include('admin/leftsidebar') 
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
                  <li class="breadcrumb-item active">Update Role</li>
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
                <h3 class="card-title">View User</h3>
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
                                <label>User Id</label>
                                <input type="text" value="{{ $user->uid }}" name="name"  class="form-control" readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ $user->email }}" name="email" class="form-control"  readonly>
                              </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>User Role</label>
                                   <select name="user_role" id="user_role" class="form-control" disabled>
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
@include('admin/footer')
@endsection
</body>
</html>   