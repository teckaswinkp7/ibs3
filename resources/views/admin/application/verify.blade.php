@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1500px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                
              </div>
              <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <form action="{{route('search.index')}}">
            <input type="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>
</form>  
          </ol>
              </div>
            </div>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid" >
            <!-- SELECT2 EXAMPLE -->
            <div class="row">
                <h3 class="card-title">Application Review Panel</h3>
                
</div>
               <!-- /.card-header -->
              
                
              
                
                        @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                        @endif

                    
                        <div class="row">
                          <div class="col-md-4">
                          <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control"  readonly>
                                <input type="hidden" value="{{ $user->id }}" name="stu_id" class="form-control"  readonly>
                              </div>
                             
                           
                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ $user->email }}" name="email" class="form-control"  readonly>
                              </div>
                            
                              <div class="form-group">
                                <label>Highest Qualification</label>
                                <input type="text" value="{{$users[0]->board}}" name="phone" class="form-control"  readonly>
                              </div>
                              <div class="form-group">
                                <label>Stream</label>
                                <select type="text" value="" name="stream" class="form-control" > 
                                <option onclick = "show1()";> Science </option>
                                <option onclick = "show2()"; > Social Science </option>

                                </select>
                              </div>
                
                              <h6> Qualification Ranking </h6>
<form action="{{route('application.obtain')}}" method="post">
  @csrf
  <table  class="table table-striped marginbtm ">
<th class="text-center"> Select Subjects Taken </th>
                  </table>
<table id="div2" class="table table-bordered table-striped hide">

  <tr>
<th> </th>
<th > Major Subjects Taken </th>
  <th> Grade </th>

                  </tr>

<tbody>
                  <tr> 


                  <td><input type="hidden" class="grade" name="language"> </td> 
                  <td> Language And Literature </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->language}}"  name="language" id="lit" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


<td><input type="hidden" class="checksubject" name="checksubject"> </td>
<td> Applied English </td>
<td><input type="text" style="width:40px;" value="{{$obt[0]->english}}" name="english" id="eng" class="grade" disabled>  </td>

</tr>
<tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Advance Mathemathics </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->maths}}" name="maths" id="math" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Economics </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->economics}}" name="economics" id="eco" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Accounting </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->accounting}}" name="accounting" id="account" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Business Studies </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->business}}" name="business" id="business" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Geography </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->geography}}" name="geography" id="geo" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> History </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->history}}" name="history" id="hist"  class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Legal Studies </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->legal}}" name="legal" id="legal" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Information Communication Technologies. </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->techno}}" name="techno" id="information" class="grade" disabled>  </td>

                  </tr>
                  </tbody>
                  </table>

                 
<table  id="div1"  class="table table-bordered table-striped ">

  <tr>
<th> </th>
<th> Major Subjects Taken </th>
  <th> Grade </th>

                  </tr>

<tbody>
                  <tr> 


                  <td><input type="hidden" class="grade" name="language"> </td> 
                  <td> Language And Literature </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->language}}"  name="language" id="lit" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


<td><input type="hidden" class="checksubject" name="checksubject"> </td>
<td> Applied English </td>
<td><input type="text" style="width:40px;" value="{{$obt[0]->english}}" name="english" id="eng" class="grade" disabled>  </td>

</tr>
<tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Advance Mathemathics </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->maths}}" name="maths" id="math" class="grade" disabled>  </td>

                  </tr>
<tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Biology </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->biology}}" name="biology" id="bio" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Chemistry </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->chemistry}}" name="chemistry" id="chem" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Physics </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->physics}}" name="physics" id="phy" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Applied Science </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->appliedscience}}" name="appliedscience" id="appsc" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Geology</td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->geology}}" name="geography" id="geo" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> ----------------------------------------------</td>
                  <td><input type="hidden" style="width:40px;" value="" name="history" id="hist"  class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td>---------------------------------------------- </td>
                  <td><input type="hidden" style="width:40px;" value="" name="legal" id="legal" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> ----------------------------------------------. </td>
                  <td><input type="hidden" style="width:40px;" value="" name="techno" id="information" class="grade">  </td>

                  </tr>
                  





                  </tbody>
                  </table>

<table class="table table-bordered table-striped">

  <tr>


  <th> </th>

  <th> Minor Subjects Taken </th>
  <th> Grade </th>

                  </tr>

<tbody>
                  <tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Practical Skills </td>
                  <td><input type="text" style="width:40px;" value="{{$obt[0]->practical}}" name="practical" class="grade" disabled>  </td>

                  </tr>
                  <tr> 


<td><input type="hidden" class="checksubject" name="checksubject"> </td>
<td> Home Economics  </td>
<td><input type="text" style="width:40px;" value="{{$obt[0]->home}}" name="home" class="grade[]" disabled>  </td>

</tr>
<tr> 


                  <td><input type="hidden" class="checksubject" name="checksubject"> </td>
                  <td> Personal Development </td>
                  <td><input type="text" name="personal" value="{{$obt[0]->personal}}" style="width:40px;" class="grade[]" disabled>  </td>

                  </tr>
                </tbody>
                </table>
<button id="option" type="submit" class="btn btn-primary float-right btncolor"> obtain </button>   
</form>   
<br>
<br>
<form action="{{route('application.send')}}" method="POST">
@csrf
<div class="card">
  <div class="card-body cardcolor">
    <div id="total">  GPA - {{$users[0]->cgpa}}


     </div>
    <div>Attainment Points -  </div>
    <div>Eligibility -  </div>
    <div>Institute - {{$users[0]->university}} </div>
    @foreach($coursesavailable as $key => $course)
    
    @php 
    $coursename = DB::table('courses')->where('courses.id',$course)->get();
    @endphp
    <div>Programme/Course - {{$coursename[0]->name}} </div>
    @endforeach
    <input type="hidden" value="{{$user->id}}" name="sid" class="form-control" >
  </div>
</div>
<button value="send-eligibility" name="eligiblebutton" type="submit" class="btn btn-primary btncolor">send-eligibility </button>
<button value="not-eligible" name="not-eligible" type="submit" class="btn btn-primary btncolor">not-eligible </button>
</div>
</form>
<div class="col-md-4">
@foreach ($student_edu as $user)
                  
                  
                  <?php 
                  $val = $user->id_image;
                  $ext = explode('.',$val);
                 // dd($val);
                  ?>
                
                 
                 <embed src="{{url('Image')}}/{{ $user->id_image}}#toobar=0" height="1000" width="860" alt="pdf"> 
               
                 @endforeach       
                 <iframe 
    src="{{url('public/public/Image')}}/{{ $users[0]->id_image}}" 
    style="width:750px; height:500px;" 
    frameborder="0">
</iframe>
<iframe 
    src="{{url('public/public/Image')}}/{{ $users[0]->highest_qualification}}" 
    style="width:750px; height:500px;" 
    frameborder="0">
</iframe>
<iframe 
    src="{{url('public/public/Image')}}/{{ $users[0]->course_syopsiy}}" 
    style="width:750px; height:500px;" 
    frameborder="0">
</iframe>


</div>
</div>                     
 <a href="{{route('application.index')}}" class="btn btn-primary  btncolor float-right"> close</a>             
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('admin.footer')
@endsection
</body>
<style>

  .marginbtm{
    margin-bottom:0px!important;
  }
.btncolor{
  background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
  border:none!important;
  
}

.cardcolor{
  background:#D3D3D3;
}
.searchbtn{

width: 11%;
padding: 5px;
background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 

color: white;
font-size: 17px;
border: none;
border-left: none;
cursor: pointer;

}
.hide {
  display: none;
}

  </style>
   <script>


function show1(){

    document.getElementById('div2').style.display ='none';
  document.getElementById('div1').style.display ='block';

}

function show2(){

    document.getElementById('div2').style.display = "block";
    document.getElementById('div1').style.display = "none";
}
        </script>

</html>   