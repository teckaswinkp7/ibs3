@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    @include('front/leftsidebar')  
        <div class="col-md-9">
        <form action="#"  enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card mt-4">
                    <div class="card-header">Exam Details</div>

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
                            <label for="name">Exam Name:</label>
                            <input type="hidden" value="{{$exam->id}}">
                            <input type="text" class="form-control" value="{{$exam->exam_name}}" readonly>
                            </div>
                            <div class="form-group">
                            <label for="name">Exam Description:</label>
                            <textarea class="ckeditor form-control" readonly>{{$exam->exam_description}}</textarea>
                            </div>
                            <label>Select Course</label>
                            <select name="course_id" id="course_id" class="form-control" disabled>
                            @foreach($course as $key=>$courses)               
                            <option {{($exam->course_id == $courses->id) ? 'selected' : ''}} value="{{$courses->id}} ">{{ $courses->name }}</option>               
                            @endforeach                                    
                            </select>
                            <div class="form-group">
                                <label>Document:</label>
                                <img src="{{ url('public/Image/'.$exam->exam_document) }}"style="height:50px; width:50px;" class="form-control"  name="document">
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
