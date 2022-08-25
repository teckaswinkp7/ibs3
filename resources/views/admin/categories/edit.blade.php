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
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update Category</li>
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
                <h3 class="card-title">Update Category</h3>
              </div>
               <!-- /.card-header -->
               <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf
                {{ method_field('PUT') }}    
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Category Name <span class="required">*</span></label>
                                <input type="text" value="{{ $category->name }}" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Category Name">
                                @error('name')
                                  <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>  
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Category Slug<span class="required">*</span></label>
                                <input type="text" value="{{  $category->slug }}" name="slug" id="@if ($errors->has('slug')) inputError @endif" class="form-control @if ($errors->has('slug')) is-invalid @endif" placeholder="Category Slug">
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
                                      @if($category)
                                      @foreach( $categories as $item)
                                        <?php $dash=''; ?>
                                        <option value="{{$item->id}}" @if($category->parent_id == $item->id ) selected @endif>{{$item->name}}</option>
                                        @if(count($item->subcategory))
                                            @include('sub-category-list-option-for-update',['subcategories' => $item->subcategory])
                                        @endif
                                      @endforeach
                                      @endif
                                    </select>
                                </div>
                              </div>  
                                <!-- /.form-group -->
                                 <div class="col-md-12">
                            <div class="form-group">
                              <label>Category Image<span class="required">*</span></label>
                              <img src="{{ url('public/Image/'. $category->cat_image) }}"style="height:50px; width:50px;" class="form-control"  name="product_image">
                              <input type="file" class="form-control"  name="cat_image" class="form-control">
                            </div>
                          </div>
                         
                        
                              <div class="col-md-12">  
                                <div class="form-group">
                                  <label>Description<span class="required">*</span></label>
                                  <textarea class="ckeditor form-control" name="description" placeholder="Description">{{ $category->description }}
                                  </textarea>
                                   @error('description')
                                        <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                    @enderror
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
                        <button type="submit" class="btn btn-primary">Update</button>
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
@include('admin\footer')
@endsection
</body>
</html>   