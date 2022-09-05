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
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Course Selection</li>
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
                <h3 class="card-title">Manage Course Selection</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                     
                  @foreach ($users as $user)
                  @if($user->status == 1)
                  @foreach ($educat as $edu)
                  @if($edu->status == 1)
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                      @if($edu->status == 1)
                      <p style="color:green;font-weight:bold;">Verified</p>
                      @endif
                      </td>
                      <td>
                        <form action="{{ route('user.destroy',$user->id) }}" method="Post">
                          <a  href="{{ route('screening.course',$user->id) }}">   
                            <i class="fa-solid  fa-eye"></i>
                          </a>
                          &nbsp;
                          @csrf
                          @method('DELETE')
                        </form>
                      </td>
                    </tr>
                  @endif 
                  @endforeach
                  @endif 
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
  @include('admin\footer') 
  @endsection
</body>
</html>  