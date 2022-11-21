@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<body>
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
            </div>  
            <h3>Select your Course </h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="userprofile">Profile</a>
                        <a href="useroffer">Course</a>
                        <a href="history">History</a>
                        {{-- <a href="#"></a>
                        <a href="#"></a> --}}
                    </div>
                </div>
                <div class="col-sm-9">
                    <p>From the documents you have submitted, you are eligible for the following courses listed below. Kindly make your choice of the course you would like to study at IBS University and receive your offer</p></p>
                    <div class="select-course">
                      @php
                        $course_list = DB::select( DB::raw("SELECT * FROM courseselections WHERE stu_id = '".Auth::user()->id."'"));
                      @endphp
                      @if(!empty($course_list))
                      @foreach($course_list as $cl)
                        @php 
                          $course_id = $cl->course_id;
                          $studentSelCid = $cl->studentSelCid;
                          $course_id = str_replace("[","",$course_id);
                          $course_id = str_replace("]","",$course_id);
                          $course_id = str_replace('"','',$course_id);
                          $course_id_arr = explode(",",$course_id);
                        @endphp
                      @endforeach
                      @foreach ($course_id_arr as $key => $val)
                      @php
                      $course_name = DB::select(DB::raw("SELECT * FROM courses WHERE id = $val"));
                      
                      @endphp

                     <a href="{{ route('coursestatus',$val) }}">{{ $course_name[0]->name }}</a>
                     @endforeach
                     @endif
                     {{-- <a href="#">Business and Management </a>
                     <a href="#">Economics and Development Studies </a>
                     <a href="#">Information Technology </a> --}}
                 </div>

                </div>
            </div>
            
        </div>
    </div>
    @include('front/footer')  

    
    @endsection   