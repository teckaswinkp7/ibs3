@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    @include('front/leftsidebar')  
        <div class="col-md-9">
        <form action="{{ route('assignmentsubmit.store') }}"  enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card mt-4">
                    <div class="card-header">Assignment Submit</div>

                    <div class="card-body">

                            
                @csrf
                <div class="card mt-1">
                    

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
                                <label for="name">Assignment Submission Description:</label>
                                <input type="hidden" value="{{$assignmentsubmit->id}}" name="assignment_id">
                                <textarea class="ckeditor form-control" name="assignment_submission_description" placeholder="Assignment Description"></textarea>
                                @error('assignment_submission_description')
                                <span class="error invalid-feedback" style="display:block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Assignment Submission Document:</label>
                                <input type="file" class="form-control"  name="assignment_submission_document" id="@if ($errors->has('assignment_submission_document')) inputError @endif" class="form-control @if ($errors->has('assignment_submission_document')) is-invalid @endif">
                                @error('assignment_submission_document')
                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                @enderror  
                            </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                   
                </div>
            </form>
                    </div>
                   
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
