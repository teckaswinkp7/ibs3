@extends('front/header')  
@section('content') 
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">
      <h1 class="mt-5">Dashboard</h1>
      @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    </div>
    </div>  
  </div>
</div>
@include('front/footer')  
@endsection
</body>
</html>   