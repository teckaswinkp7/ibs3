@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    @include('front/leftsidebar')  
        <div class="col-md-9">
            <form action="#" method="POST">
                @csrf
                <div class="card mt-5">
                    <div class="card-header">Assignment</div>

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

                            <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Assignment Title</th>
                            <th scope="col">Assignment Description</th>
                            <th scope="col">Assignment Submission Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($assignment as $assignments)
                            <tr>
                                <th scope="row">{{$assignments->id}}</th>
                                <td>{{$assignments->assignment_title}}</td>
                                <td>{{$assignments->assignment_description}}</td>
                                <td>{{$assignments->assignment_submission_date}}
                                </td>
                                <td>@if(($assignments->status)==1) Submitted @else<a href="{{ route('assignmentsubmit.submit',$assignments->id) }}">Submit Assignment</a>@endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        
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
