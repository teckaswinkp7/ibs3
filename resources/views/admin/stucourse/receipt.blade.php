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
              <li class="breadcrumb-item active">View Student Receipt</li>
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
                <h3 class="card-title">View Student Receipt</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>View Receipt</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @if((!empty($data)))
                      @foreach($data as $key => $val)   
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $val->name }}</td>
                          <td>{{ $val->csname }}</td>
                          <td><a href="{{Url('public/uploads/receipt')}}/{{ $val->receipt }}" target="_blank"><img src="{{Url('public/uploads/receipt')}}/{{ $val->receipt }}" style="width:100px;height:100px;"></a></td>                          
                        </tr>
                      @endforeach
                    @endif   
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>View Receipt</th>
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