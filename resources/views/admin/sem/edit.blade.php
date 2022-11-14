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
                <a class="btn btn-primary" href="{{route('admin.sem.index')}}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active"> Edit Sem Fee  </li>
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
                <h3 class="card-title">Edit  Sem Fee </h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('admin.sem.update',$sem->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf  
                
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>  Name </label>
                            <input type="text" value="{{$sem->name}}" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif " placeholder="Sem Name">
                            @error('name')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>

                        <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Description </label>
                            <input type="text" name="info" value="{{$sem->info}}" id ="@if ($errors->has('info')) inputError @endif" class="form-control @if ($errors->has('info')) is-invalid @endif" placeholder=" Description ">
                             @error('info')
                             <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
</div>
</div>
<div class="col-md-12">
                          <div class="form-group">
                            <label  > Price</label>
                            <input class="form-control" value="{{$sem->price}}" name="price" type="number" placeholder=" Price"> 
    
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status" >Course  </label>
                            <select class="form-control" required name="status">
                            <option value="">
                                course Name
</option>
</select>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                
                </div>
                        </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
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