@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  

    <div class="background-submission" style="margin-top:100px;"> 
        <div class="submission-modal">
            <div class="register-logo">
                <a href="#"><img src="{{asset('assets/custom/New Project (14).png')}}" alt="" width="120px"></a>
            </div>  
            <h3>Documents submitted successfully!</h3>
            <form action="" class="submission-form">
                <div class="submission row">
                   
                <div class="col-sm-6">
                    <p>Documents</p>
                    {{-- <input type="text" value="Grade 12 Certificate" disabled> --}}
                    <input type="text" value="{{ $newval[0]->board }} " disabled>
                </div>
                <div class="col-sm-3">
                    <p>Status</p>
                    @if($newval[0]->verification_status == 1)
                    <input type="text" value="Document Verified" disabled>    
                    @elseif($newval[0]->verification_status == 2)      
                    <input type="text" value="Decline" disabled>          
                    @else
                    <input type="text" value="Verification Pending" disabled>
                    @endif
                    {{-- <input type="text" value="Verification Pending " disabled> --}}
                </div>
                <div class="col-sm-3">
                    <p>Action</p>
                    @if($newval[0]->verification_status == 1)
                    <input type="text" value="Verified" disabled>
                    @elseif($newval[0]->verification_status == 2) 
                    <input type="text" value="Decline" disabled>   
                    @else
                    <input type="text" value="Awaiting" disabled>
                    @endif
                    {{-- <input type="text" value="Awaiting " disabled> --}}
                </div>
               
                </div>
                @if($newval[0]->verification_status != 2)
                <div class="submission-btn">
                <button class=""><a style="color: #fff; text-decoration:none;" href="{{route('userprofiles')}}">Prompt review</a></button>
                </div>
                @endif
                <div class="imp-submission">
                    <h6>Important</h6>
                    <p>Please note the following instructions for a smooth Application to Admission into IBS University.</p>
                    <ul>
                        <li> Your submitted document will be assigned to an Enrolment Officer who will review your documents. If you have not received a response after 14 working days, an option will be made available for you to send your follow-up here on your iConnect Portal.</li>
                        <li>Once the enrolment officer reviews your documents, they will make available to you the courses that you are eligible for</li>
                        <li> These courses that you are eligible for will be made available here, in your iConnect Portal for you to make your preferred selection that you wish to undertake at IBS University</li>
                        <li>Once you make your selection of the Course of your choice, you will immediately receive your offer</li>
                        <li>When you receive your offer, you can either Accept or Decline your offer. If you accept your offer, you will immediately receive your acceptance letter and sign; You will also receive your offer through email. If you decline, you will be asked to select a different Course of your choice again. </li>
                        <li>After you receive your offer, you will then follow the next steps to obtain your invoice</li>
                    </ul>
                    <p>Feel free to reach out to our Admin on 74114100 or email ask@ibs.ac.pg if you need more clarity.</p>
                </div>
                    
          </form>
          <div class="submission-btn">
                <button class=""><a style="color: #fff; text-decoration:none;" href="{{route('userprofiles')}}">Complete Profile</a></button>
                </div>
        </div>
    </div>
@include('front/footer')  
@endsection  