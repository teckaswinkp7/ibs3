@extends('header')  
@section('content')
@include('leftsidebar') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height:2303px !important;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Update Product</li>
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
        <h3 class="card-title">Update Product</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('product.update',$products->id) }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
        @csrf  
        @method('PUT')  
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Product Name <span class="required">*</span></label>
                <input type="text" name="name" id="@if ($errors->has('name')) inputError @endif" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Product Name" value="{{ $products->name }}">
                @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Product Slug <span class="required">*</span></label>
                <input type="text" name="slug" id="@if ($errors->has('slug')) inputError @endif" class="form-control @if ($errors->has('slug')) is-invalid @endif" placeholder="Product Slug" value="{{ $products->slug }}">
                @error('slug')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <div class="form-group">
                <label>Categories<span class="required">*</span></label>
                <select name="cat_id" id="cat_id" class="form-control">
                @foreach($category as $key=>$cat_data)
                @foreach ($products->category as $cat)
                @if($cat_data->id==$cat->id)
                <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                @else
                <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                @endif  
                @endforeach
                 @endforeach
                </select>
                @error('cat_id')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
               @enderror  
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group" id="child_cat_div">
                <label>SubCategories</label>
                <select class="browser-default custom-select" name="subcat_id" id="subcat_id">
                @foreach ($products->subcategory as $subcat)
                <option value='{{$subcat->id}}'>{{$subcat->name}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Featured</label>
                <div class="custom-switch custom-switch-label-onoff pl-0">    
                  <input class="custom-switch-input" id="example_03" type="checkbox" name='is_featured' id='is_featured' value='1' checked>
                  <label class="custom-switch-btn" for="example_03"></label>  
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Sale Price<span class="required">*</span></label>
                <input type="text" name="sale_price" id="@if ($errors->has('sale_price')) inputError @endif" class="form-control @if ($errors->has('sale_price')) is-invalid @endif" placeholder="Sale Price" value="{{ $products->sale_price }}" >
                @error('sale_price')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
                @enderror  
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Regular Price<span class="required">*</span></label>
                <input type="text" name="regular_price" id="@if ($errors->has('regular_price')) inputError @endif" class="form-control @if ($errors->has('regular_price')) is-invalid @endif" placeholder="Regular Price" value="{{ $products->regular_price }}">
                @error('regular_price')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
                @enderror  
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Product Image<span class="required">*</span></label>
                <img src="{{ url('public/Image/'.$products->product_image) }}"style="height:50px; width:50px;" class="form-control"  name="product_image">
                <input type="file" class="form-control"  name="product_image" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Quantity<span class="required">*</span></label>
                <input id="quantity @if ($errors->has('stock')) inputError @endif" type="number" name="stock" min="0" placeholder="Enter Quantity" 
                class="form-control @if ($errors->has('stock')) is-invalid @endif" value="{{ $products->stock }}">
                @error('stock')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
                @enderror 
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Short Description<span class="required">*</span></label>
                <textarea class="ckeditor form-control" name="short_description" placeholder="Short Description">
                  {{$products->short_description }}
                </textarea>
                @error('short_description')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
                @enderror 
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Long Description<span class="required">*</span></label>
                <textarea class="ckeditor form-control" name="long_description" placeholder="Long Description">
                   {{$products->long_description }}
                </textarea>
                @error('long_description')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
                @enderror 
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Additional Description<span class="required">*</span></label>
                <textarea class="ckeditor form-control" name="additional_information" placeholder="Long Description">
                  {{$products->additional_information}}
                </textarea>
                @error('additional_information')
                <span class="error invalid-feedback d-block">{{ $message }}</span>
                @enderror 
              </div>
            </div>
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
@include('footer')
<script type="text/javascript">
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$(document).ready(function () {
$('#cat_id').on('change',function(e) {
var cat_id = e.target.value;
$.ajax({
url:"{{ route('subcat') }}",
type:"POST",
data: {
cat_id: cat_id
},
success:function (data) {
if(data.subcategories[0].subcategories==""){
$('#child_cat_div').addClass('d-none');
}  
$('#subcat_id').empty();
$.each(data.subcategories[0].subcategories,function(index,subcat_id){
$('#child_cat_div').removeClass('d-none');  
$('#subcat_id').append('<option value="'+subcat_id.id+'">'+subcat_id.name+'</option>');
})
}
})
});
});
</script>
@endsection
</body>
</html>   