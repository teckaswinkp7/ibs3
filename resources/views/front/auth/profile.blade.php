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
        <h3>Your Profile </h3>
        <div class="row">
            <div class="col-sm-3">
                <div class="profile-course">
                    <a href="userprofile">Profile</a>
                    <a href="useroffer">Course</a>
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>
            <div class="col-sm-9">
                <h6 class="user-credentials">User credentials</h6>
                <div class="profile-box">
                    <div class="profile-photo">
                       <img src="{{asset('assets/custom/profile-photo.jpg')}}" alt="" width="100px">
                       <img src="{{asset('assets/custom/edit-icon.jpg')}}" alt="" width="18px" height="auto">
                    </div>
                    <div class="profile-details">
                       <div>
                          <label for="">ID</label>
                          <input type="text" value="{{$allval->college_id}}">
                       </div>
                       <div>
                        <label for="">Username</label>
                        <input type="text" value="{{$val['email']}}">
                        <a href="">(Update)</a>
                     </div>
                     <div>
                        <label for="">Password</label>
                        <input type="text" value="********">
                        <a href="">(Reset)</a>
                     </div>
                    </div>
                </div>
                <form action="{{route('updateprofile')}}" class="submission-form" method="post">
                    @csrf
                    <input type="hidden" name="stu_id" value="{{Auth::id()}}">
                <div class="profile-personal-details">
                    <h6 class="user-credentials">Personal Details</h6>
                    <div class="personal-info">
                        <div>
                            <label for="title">Title*</label>                            
                            <input type="text" value="{{$allval->title}}" name="title" required>
                         </div>
                         <div>
                            <label for="">First name*</label>
                            <input type="text" value="{{$val->first_name}}" disabled required>
                         </div>
                         <div>
                            <label for="">Middle name</label>
                            <input type="text" value="{{$val->mname}}" disabled>
                         </div>
                         <div>
                            <label for="">Last name*</label>
                            <input type="text" value="{{$val->lname}}" disabled>
                         </div>
                         <div>
                            <label for="">Date of birth*</label>
                            <input type="date" value="{{$allval->dob}}" name="dob">
                         </div>
                         <div>
                            <label for="">Email*</label>
                            <input type="email" value="{{$val->email}}" disabled>
                         </div>
                         <div>
                            <label for="">Alt. Email</label>
                            <input type="email" value="{{$allval->alternate_email}}" name="alternate_email">
                         </div>
                         <div>
                            <label for="">Phone*</label>
                            <input type="text" value="{{$val->phone}}" name="phone" disabled>
                         </div>
                         <div>
                            <label for="">Alt. Phone</label>
                            <input type="text" name="alternet_phone" value="{{$allval->alternet_phone}}">
                         </div>
                    </div>
                    <h6 class="user-credentials">Background Info</h6>
                    <div class="background-info">
                        <div>
                            <label for="province">Home Province*</label>
                            <input type="text" value="{{$allval->secondary_school}}"  name="secondary_school" >
                         </div>
                         <div>
                            <label for="">Secondary School*</label>
                            <input type="text" value="Hagen Secondary School" required>
                            <input type="year" value="{{$allval->secondary_school_completed}}"  name="secondary_school_completed" >
                         </div>
                         <div> 
                            <label for="">Tertiary Education</label>                      
                              <input type="text" name="tertiary_education" value="{{$allval->tertiary_education}}" placeholder="Name of Institute">
                              <input type="text" name="tertiary_education_year" value="{{$allval->tertiary_education_year}}" placeholder="Year completed">                                                                                  
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" name="tertiary_education_location" value="{{$allval->tertiary_education_year}}" placeholder="Location" >                                                                                                                  
                         </div>
                         <div>
                            <label for="">Other Education</label>
                            <input type="text" placeholder="Name of Institute" value="{{$allval->other_education}}" name="other_education">
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Location" value="{{$allval->other_education_location}}" name="other_education_location">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Current Location</label>
                            <input type="text" placeholder="Location" value="{{$allval->current_location}}" name="current_location">
                            <input type="text" placeholder="Phone" value="{{$allval->current_address_phone}}" name="current_address_phone">  
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Address" value="{{$allval->current_address_location}}" name="current_address_location">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Father’s Contact</label>
                            <input type="text" placeholder="Full name" value="{{$allval->fathers_name}}" name="fathers_name">
                            <input type="text" placeholder="Phone" value="{{$allval->fathers_contact}}"  name="fathers_contact"> 
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Email Address" value="{{$allval->fathers_email}}"  name="fathers_email">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Mother's Contact</label>
                            <input type="text" placeholder="Full name" value="{{$allval->mothers_name}}"  name="mothers_name">
                            <input type="text" placeholder="Phone" value="{{$allval->mothers_contact}}"  name="mothers_contact"> 
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="email" placeholder="Email Address" value="{{$allval->mothers_email}}"  name="mothers_email">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Guardian Contact</label>
                            <input type="text" placeholder="Full name" value="{{$allval->guardian_name}}"  name="guardian_name">
                            <input type="text" placeholder="Phone" value="{{$allval->guardian_contact}}"  name="guardian_contact"> 
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="email" placeholder="Email Address" value="{{$allval->guardian_email}}" name="guardian_email">                                                                                                                  
                         </div>
                         <div>
                            <label for="">Current Employment</label>
                            <input type="text" placeholder="I am currently working at" value="{{$allval->current_employment}}"  name="current_employment">
                         </div>
                         <div> 
                            <label for=""></label>                      
                            <input type="text" placeholder="Work Address" value="{{$allval->work_address}}"  name="work_address">                                                                                                                  
                         </div>
                    </div>

                    
            <div class="submission row">
            <div class="col-sm-8">
                <p>Documents</p>
                <input type="text" value="{{$newval[0]->board}} Grade 12 Certificate" disabled>
                {{-- <input type="text" value="Diploma in Accounting " disabled> --}}
            </div>
            <div class="col-sm-4">
                <p>Status</p>
                @if($newval[0]->verification_status == 1)
               <input type="text" value="Verified" disabled>
               @elseif($newval[0]->verification_status == 2) 
               <input type="text" value="Decline" disabled>   
               @else
               <input type="text" value="Awaiting" disabled>
               @endif
                
                {{-- <input type="text" value="Verification Pending " disabled> --}}
            </div>
            </div>
            <div class="submission-btn">
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