@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
<div class="row justify-content-center">   
<div class="col-md-9">
<div class="card custom-margin">
<div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <h4> {{$page->title}} </h4>
      <hr>
<div>
 {!!$page->body!!}
</div>
</div> 
</div>
</div>
</div>
</div>
</div>
</div>

@include('front/footer') 
@endsection
 
</body>

</html>   