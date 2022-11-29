@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
 
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<style>
*{
   list-style-type: none;
}

   </style>
    

<div class="background-profile" style="margin-top: 100px;"> 
    <div class="profile-modal" style="width: 100%;">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        <h3>Your Profile </h3>
        <div class="row">
            <div class="col-sm-2">
                <nav class="profile-course">
                  <ul>

                   <li> <a href="sponsorprofile">Profile</a></li>
                    <li><a href="viewstudents">View Students</a></li>
                    <li class="bill"><a href="payment">Payment</a></li>
                  <li class="bill"><a href="sponsorhistory">History</a></li>
                    </ul>
</nav>
            </div>
            <div class="col-sm-9">
                <h6 class="user-credentials">User credentials</h6>
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>        
                    @endif  
                <div class="profile-box">
                    <div class="profile-photo">
                       <img src="{{asset('assets/custom/profile-photo.jpg')}}" alt="" width="100px">
                       <img src="{{asset('assets/custom/edit-icon.jpg')}}" alt="" width="18px" height="auto">
                    </div>
                    
                    <div class="profile-details">
                       <div>
                          <label for="">ID : </label>
                          <input name="sponsor_id" type="text" value="{{$sponsordata[0]->sponsor_id}}">
                       </div>
                       <div>
                        <label for="sponsor_email">Username : </label>
                        <input name="sponsor_email" type="email" value="{{$sponsordata[0]->sponsor_email}}" style="width: 100%;">
                        <a href="changeuser">(Update)</a>
                     </div>
                     <div>
                        <label for="">Password</label>
                        <input type="text" value="********">
                        <a href="changepassword">(Reset)</a>
                     </div>
                    </div>
                </div>


                <form action="{{route('sponsorprofilepost')}}" class="submission-form" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{Auth::id()}}">
                    <div class="row">
                    <div class="col-sm-6" >
                <div class="profile-personal-details">
                    <h6 class="user-credentials"> <strong> Personal Details 
</strong>
                    </h6>
                    <div class="personal-info">
                        <div>
                            <label for="title">Title*</label>                            
                            <input type="text" value="{{$sponsordata[0]->title}}" name="title" required>
                         </div>
                         <div>
                            <label for="">First name*</label>
                            <input type="text"  value="{{$sponsordata[0]->sponsor_name}}" disabled required>
                         </div>
                         <div>
                            <label for="">Middle name</label>
                            <input type="text" name="middle_name" value="{{$sponsordata[0]->middle_name}}" >
                         </div>
                         <div>
                            <label for="">Last name*</label>
                            <input type="text" name="last_name" value="{{$sponsordata[0]->last_name}}" >
                         </div>
                         <div>
                            <label for="">Position*</label>
                            <input type="text" value="{{$sponsordata[0]->position}}" name="position">
                         </div>
                         <div>
                            <label for="">Email*</label>
                            <input type="email" value="{{$sponsordata[0]->sponsor_email}}" disabled>
                         </div>
                         <div>
                            <label for="">Alt. Email</label>
                            <input type="email" value="{{$sponsordata[0]->alt_email}}" name="alt_email">
                         </div>
                         <div>
                            <label for="">Phone*</label>
                            <input type="text" value="{{$sponsordata[0]->sponsor_phone}}" name="phone" disabled>
                         </div>
                         <div>
                            <label for="">Alt. Phone</label>
                            <input type="text" name="alt_phone" value="{{$sponsordata[0]->alt_phone}}">
                         </div>
                    </div>
                    </div>
</div>
                    <div class="col-sm-6" >
                    <h6 class="user-credentials" > <strong> Location </strong> </h6>
                    <div class="personal-info" >
                        <div>
                            <label for="province">Company Name *</label>
                            <input type="text" value="{{$sponsordata[0]->company_name}}"  name="company_name" >
                         </div>
                         <div>
                            <label for="province">Province *</label>
                            <input type="text"  value="{{$sponsordata[0]->province}}" name="province" required>
                         </div>
                         <div> 
                            <label for="address">Address*</label>                      
                              <input type="text" name="address" value="{{$sponsordata[0]->address}}">                                                                             
                         </div>
                         <div>
                            <label for="">Main Phone Line*</label>
                            <input type="text"  value="{{$sponsordata[0]->main_phone_line}}" name="main_phone_line">
                         </div>
                         <div>
                            <label for="">Alt Phone Line</label>
                            <input type="text"  value="{{$sponsordata[0]->alt_phone_line}}" name="alt_phone_line">  
                         </div>
                    </div>
</div>
<div class="submission row">
           <div class="submission-btn">
                <button type="submit">Save</button>
            </div>
</div>
</div>

    
         
                
                    </form>
                </div>

            </div>
        </div>
        
    </div>
    
    @include('front/footer')  

    
    @endsection   