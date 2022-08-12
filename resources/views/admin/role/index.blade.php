@extends('admin\header')  
@section('content')
@include('admin\leftsidebar') 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a class="btn btn-success" href="{{ route('role.create') }}"> Create Role</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Role</li>
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
                <h3 class="card-title">Manage Role</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Role Name</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  @foreach ($role as $roles)
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td>{{ $roles->name }}</td>
                      <td>
                        <form action="{{ route('role.destroy',$roles->id) }}" method="Post">
                          <a  href="{{ route('role.show',$roles->id) }}">   
                            <i class="fa-solid  fa-eye"></i>
                          </a>
                          &nbsp;
                          <a  href="{{ route('role.edit',$roles->id) }}"> 
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
                  <th>Role Name</th>
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
  @include('admin\footer') 
  @endsection
</body>
</html>  