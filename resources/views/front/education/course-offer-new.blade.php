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
.dropdown-container {
  display: none;
}

.dropdown-btn {
 
  cursor: pointer;
  outline: none;
}

.atag{


  background-color: #cc6600;
  border:none;

}
.atag:hover{


background-color: #cc6600;
border:none;

}



</style>
<body>
    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
            </div>  
            <h3>Select your Course </h3>
            <div class="row">
                <div class="col-sm-3">
                <div class="profile-course sidenav">
                
                  
                <ul>

                 <li> <a href="userprofile">Profile</a></li>
                  <li><a href="useroffer">Course</a></li>
                  <a class="dropdown-btn"> Bill <i class="fa fa-caret-down"></i> </a>
  

<div class="dropdown-container">
  <a href="proformainvoice">Invoice</a>
  <a href="confirmpayment">Payment</a>
  <a href="history">History</a>
</div>
             </ul>
</div>   
                </div>
                <div class="col-sm-9">
                    <p>From the documents you have submitted, you are eligible for the following courses listed below. Kindly make your choice of the course you would like to study at IBS University and receive your offer</p></p>
                    <div class="select-course">
                        @php 
                        $id = auth::id();
                        $student_course_offer= DB::table('courseselections')->select("courses.name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
                        @endphp 
                      @php
                        $course_list = DB::select( DB::raw("SELECT * FROM courseselections WHERE stu_id = '".Auth::user()->id."'"));
                        
                      @endphp
                     @php
                      $id = Auth::id();
                    $offer = DB::table('users')->select('offer_accepted')->where('id',$id)->get();
                    $offeraccepted = $offer[0]->offer_accepted;
                     @endphp
                      @if($offeraccepted == 'yes')
                     <span><a class="badge badge-success">Selected Course : {{ $student_course_offer[0]->name}}</a> </span>
</br>
                    <span class="row tag">
                     <p> If you would like to change to another course <form action="{{url('education/create-step-two')}}"> <button class="btn btn-primary atag" type="submit"> Click Here </button> </form> </p>
</span>
                     @else
                    @if($review[0]->review_accept == '1')
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
                       <a href="{{ route('coursestatus',$val) }}">{{ $course_name[0]->name }} <button class="btn btn-primary btnslct float-right"> select </button></a> 
                       
                     @endforeach
                     @endif
                     @else
                       <a> waiting for Enrollment officers approval </a>
                     @endif
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
    <script>

    var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}




   </script>
<style>

  .btnslct{

    background-color:#cc6600;
    border:none;
    border-radius:0px;


  }
  .btnslct:hover{

    background-color:black;
    border:none;
    border-radius:0px;

  }
  </style>
  <script>

$(.atag).click(function(){

window.location.href = '{{url('/userdefer')}}';


});









</script>
    
    @endsection   