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
            <!-- <h1><a class="btn btn-success" href="{{ route('categories.create') }}"> Create Category</a></h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">View Sponsors</li>
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
                <h3 class="card-title">View Sponsors</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Sponosr</th>
                  <th>Email</th>
                  <th>Phone</th>                  
                  <th>Student Name</th>
                  <th>Course Name</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  @foreach ($sponsorDetails as $value)
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td>{{ $value->sponsor_name }}</td>
                      <td>{{ $value->sponsor_email }}</td>
                      <td>{{ $value->sponsor_phone }}</td>
                      <td>{{ $value->student_name }}</td>
                      <td>{{ $value->course_name }}</td>
                      
                      <!-- <td>                        
                          <a  href="{{ route('bank.edit',$value->id) }}"> 
                            <i class="fa-solid fa-pen-to-square"></i>
                          </a>                     
                      </td> -->
                    </tr> 
                  @endforeach
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Sponosr</th>
                  <th>Email</th>
                  <th>Phone</th>                  
                  <th>Student Name</th>
                  <th>Course Name</th>
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