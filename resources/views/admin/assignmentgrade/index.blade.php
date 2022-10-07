@extends('admin.header')  
@section('content')
@include('admin.leftsidebar') 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ Session::get('message') }}</strong>
        </div>
        @endif 
        </div>
      </div>  
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Assignment Grade</li>
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
                <h3 class="card-title">Manage Assignment Grade</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Assignment Title</th>
                  <th>Assignment Submission Description</th>
                  <th>Assignment Submission Date</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody> 
                  <?php 
                  $_SESSION['i'] = 0; 
                  ?> 
                            
                  @foreach ($assignmentsub as $grade)
                  <?php $_SESSION['i']=$_SESSION['i']+1; 
                  
                  ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td>{{ $grade->assignment_title }}</td>
                      <td>{{ $grade->assignment_submission_description }}</td>
                      <td>{{ $grade->assignmentsubmission_date }}</td>
                      <td> <a href="{{ route('assignmentgrade.grade',$grade->id) }}">Assignment Grade</a></td>
                    </tr> 
                   
                  @endforeach
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Assignment Title</th>
                  <th>Assignment Submission Description</th>
                  <th>AssignmentSubmission Date</th>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script type="text/javascript">
    $('.show_confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: 'Are you sure you want to delete this record?',
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
    });
  </script>
@endsection
</body>
</html>  