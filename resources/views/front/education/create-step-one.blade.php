@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    @include('front/leftsidebar')  
        <div class="col-md-9">
            <form action="{{ route('education.create.step.one.post') }}" method="POST">
                @csrf
                <div class="card mt-5">
                    <div class="card-header">Step 1: Basic Info</div>

                    <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name"  value="{{ $user[0]->name ?? '' }}" name="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text"  class="form-control" id="email" value="{{ $user[0]->email ?? '' }}" name="email" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text"  class="form-control" id="phone" value="{{ $user[0]->phone ?? '' }}" name="phone" readonly/>
                            </div>

                        
                    </div>
                    @if(Auth::user()->user_role == 2)
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary float-right">Next</button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@include('front/footer')  
@endsection
</body>
</html>   
