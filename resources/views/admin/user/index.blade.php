@extends('admin.header')  
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a class="btn btn-success" href="{{ route('user.create') }}"> Create User</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  @foreach ($users as $user)
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                      @foreach($role as $key=>$cat_data)
                      @foreach ($user->role as $cat)
                      @if($cat_data->id==$cat->id)
                      {{$cat_data->name}}
                      @endif 
                      @endforeach
                      @endforeach
                      </td>
                      <td>
                        <form action="{{ route('user.destroy',$user->id) }}" method="Post">
                          <a  href="{{ route('user.show',$user->id) }}">   
                            <i class="fa-solid  fa-eye"></i>
                          </a>
                          &nbsp;
                          <a  href="{{ route('user.edit',$user->id) }}"> 
                            <i class="fa-solid fa-pen-to-square"></i>
                          </a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" style="border:0px !important;">
                            <i class="fa-solid fa-trash-can"></i>
                          </button>
                        </form>
                      </td>
                    </tr> 
                  @endforeach
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @include('admin.footer') 
  @endsection
</body>
</html>  