@extends('admin.header')  
@section('content')
@include('admin.leftsidebar') 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{route('admin.menuitems.index')}}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active"> Edit Menu </li>
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
                <h3 class="card-title"> Edit Menu </h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('admin.menuitems.update',$menu->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf    
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Menu Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Menu Name" value="{{$menu->name}}">
            
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status" >Status </label>
                            <select class="form-control" required name="status" >
                            <option>
                                Enabled
</option>
<option> 
    Disabled
</option>
</select>
                          </div>
                        </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label> Menu item Link </label>
                              <input type="text" class="form-control" placeholder="Enter Link" name="link" value="{{$menu->link}}">
                             
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