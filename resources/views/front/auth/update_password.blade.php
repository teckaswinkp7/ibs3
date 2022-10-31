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
        {{-- <h3>Your Profile </h3> --}}
        <div class="row">
            <div class="col-sm-3">
                <div class="profile-course">
                    <a href="userprofile">Profile</a>
                    <a href="useroffer">Course</a>
                    {{-- <a href="#"></a>
                    <a href="#"></a> --}}
                </div>
            </div>
            <div class="col-sm-9">
                <h6 class="user-credentials">User credentials</h6>
               
                <form action="{{route('updatepasswords')}}" class="submission-form" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{Auth::id()}}">
                <div class="profile-personal-details">
                    {{-- <h6 class="user-credentials">Personal Details</h6> --}}
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>        
                    @endif  
                    <div class="personal-info">
                        <div>
                            <label for="title">Password</label>                            
                            <input type="password"  name="password" required>
                        </div>

                        <div>
                        <label for="title">Confirm Password</label>                            
                        <input type="password"  name="confirm_password" required>
                        </div>
                    </div>
            <div class="submission-btn">
                <button><a href="userprofile" style="color: #fff; text-decoration:none;">Back</a></button>
                <button type="submit">Save</button>
            </div>
                
                    </form>
                </div>

            </div>
        </div>
        
    </div>
</div>
    @include('front/footer')  

    
    @endsection   