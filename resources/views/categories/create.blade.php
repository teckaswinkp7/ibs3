@extends('header')  
@section('content')
@include('leftsidebar') 
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1545px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add Categories</li>
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
                <h3 class="card-title">Add Categories</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf    
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Category Name <span class="required">*</span></label>
                            <input type="text" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Course Name">
                            @error('name')
                              <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Category Slug<span class="required">*</span></label>
                            <input type="text" name="slug" id="@if ($errors->has('slug')) inputError @endif" class="form-control @if ($errors->has('slug')) is-invalid @endif" placeholder="Course Slug">
                            @error('slug')
                            <span class="error invalid-feedback">{{ $message }}</span>
                             @enderror
                          </div>
                        </div>
                          <!-- /.col -->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select Parent Category</label>
                                <select type="text" name="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($categories as $category)
                                    <?php $dash=''; ?>
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @if(count($category->subcategory))
                                        @include('subCategoryList-option',['subcategories' => $category->subcategory])
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                          </div>
                            <!-- /.form-group -->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Category Image<span class="required">*</span></label>
                              <input type="file" class="form-control"  name="cat_image" id="@if ($errors->has('cat_image')) inputError @endif" class="form-control @if ($errors->has('cat_image')) is-invalid @endif">
                              @error('cat_image')
                              <span class="error invalid-feedback d-block">{{ $message }}</span>
                              @enderror  
                            </div>
                          </div>
                          
                            <div class="col-md-12">
                            <div class="form-group">
                              <label>Description<span class="required">*</span></label>
                              <textarea class="ckeditor form-control" name="description" placeholder="Description">
                              </textarea>
                               @error('description')
                                    <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                @enderror
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
@include('footer')
@endsection
</body>
</html>   