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
                <a class="btn btn-primary" href="{{route('enrollment.index')}}"> Back</a>
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
                <h3 class="card-title">Verify Document</h3>
              </div>
               <!-- /.card-header -->
               
                <form action="{{ route('enrollment.store') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
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
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control"  readonly>
                                <input type="hidden" value="{{ $user->id }}" name="stu_id" class="form-control"  readonly>
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
                                <label>Phone</label>
                                <input type="text" value="{{ $user->phone }}" name="phone" class="form-control"  readonly>
                              </div>
                            </div> 
                            <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  {{-- <th>Qualification</th> --}}
                  <th>Board</th>
                  {{-- <th>Percentage</th> --}}
                  <th>ID Image</th>
                  <th>Heighest Qualification</th>
                  <th>Course Synopsis</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  @foreach ($student_edu as $user)
                  
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      {{-- <td>{{ $user->qualification }}</td> --}}
                      <td>{{ $user->board }}</td>
                      {{-- <td>{{ $user->percentage }}</td> --}}
                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                      if($ext[1] == 'pdf')
                      { ?>
                        <td><a href="{{url('public/public/Image')}}/{{ $user->id_image }}" target="_blank"><img src="{{url('public/uploads/pdf_icon.png')}}" style="width:100px;height:100px;"></a></td>
                      <?php }
                      else{ ?>
                        <td><a href="{{url('public/public/Image')}}/{{ $user->id_image }}" target="_blank"><img src="{{url('public/Image')}}/{{ $user->id_image }}" style="width:100px;height:100px;"></a></td>
                      <?php }
                      ?>

                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                      if($ext[1] == 'pdf')
                      { ?>
                        <td><a href="{{url('public/public/Image')}}/{{ $user->highest_qualification }}" target="_blank"><img src="{{url('public/uploads/pdf_icon.png')}}" style="width:100px;height:100px;"></a></td>
                      <?php }
                      else{ ?>
                        <td><a href="{{url('public/public/Image')}}/{{ $user->highest_qualification }}" target="_blank"><img src="{{url('public/public/Image')}}/{{ $user->highest_qualification }}" style="width:100px;height:100px;"></a></td>
                      <?php }
                      ?>

                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                      if($ext[1] == 'pdf')
                      { ?>
                        <td><a href="{{url('public/public/Image')}}/{{ $user->course_syopsiy }}" target="_blank"><img src="{{url('public/uploads/pdf_icon.png')}}" style="width:100px;height:100px;"></a></td>
                      <?php }
                      else{ ?>
                        <td><a href="{{url('public/public/Image')}}/{{ $user->course_syopsiy }}" target="_blank"><img src="{{url('public/public/Image')}}/{{ $user->course_syopsiy }}" style="width:100px;height:100px;"></a></td>
                      <?php }
                      ?>
                      
                    </tr> 
                  @endforeach
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  {{-- <tr>
                  <th>Sl.No.</th>
                  <th>Qualification</th>
                  <th>Board</th>
                  <th>Percentage</th>
                  <th>Document</th>
                  </tr> --}}
                  </tfoot>
                </table>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Document Verified</label>
                    <div class="form-check">
                    <label class="form-check-label" for="radio1">
                    <input type="radio" class="form-check-input" id="status" name="status" value="1">Yes
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio2">
                    <input type="radio" class="form-check-input" id="status" name="status" value="2">No
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