@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  



 
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
            </div>  
            <h3>Select the date</h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="userprofile">Profile</a>
                        <a href="useroffer">Course</a>
                        <a href="useroffer">Bill</a>
                        {{-- <a href="#"></a>
                        <a href="#"></a> --}}
                    </div>
                </div>
                <div class="col-sm-9">
                   
                    <div class="offer">
        
                        <div>
                            <h6>Defer Offer</h6>
                            <p>If you defer your offer, your offer will be post-ponded to a time you will set to accept your offer and claim your space at that time </p>
                        </div>

                    </div>
                    <form method="post" action="{{route('coursedefersdate')}}">
                        @csrf
                      
                    <div class="deffer-course">       
                <input type="text" value="" name="defer_date" class="datepicker" placeholder="Select date">
              
                </div>
                <button class="submission-btn" type="submit">Submit </button>
                <button > <a href="{{url('userprofile')}}" > Cancel </a></button>
            </form>

                </div>
            </div>
            
        </div>
    </div>
    @include('front/footer')  

    
    @endsection  