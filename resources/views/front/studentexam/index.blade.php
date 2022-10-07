@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
    @include('front/leftsidebar')  
        <div class="col-md-9">
            <form action="#">
                @csrf
                <div class="card mt-5">
                    <div class="card-header">Exam</div>

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
                            <th scope="col">Exam Name</th>
                            <th scope="col">Exam Description</th>
                            <th scope="col">Exam Duration</th>
                            <th scope="col">Action</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php $_SESSION['i'] = 0; ?>
                        @foreach($exam as $studentexam)
                        <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                            <tr>
                            <?php $dash=''; ?>
                                <td>{{$_SESSION['i']}}</td>
                                <td>{{$studentexam->exam_name}}</td>
                                <td>{{$studentexam->exam_description}}</td>
                                <td>{{$studentexam->exam_duration}}</td>
                                <td><a href="{{ route('studentexam.show',$studentexam->id) }}">Details</a></td>
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
