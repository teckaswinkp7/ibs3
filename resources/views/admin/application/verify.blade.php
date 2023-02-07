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
                                <input type="text" value="{{$user->highest_qualification }}" name="phone" class="form-control"  readonly>
                              </div>
                              <div class="form-group">
                                <label>Stream</label>
                                <select type="text" value="" name="stream" class="form-control" > 
                                <option> Science </option>
                                <option> Social Science </option>

                                </select>
                              </div>
                
                              <h6> Qualification Ranking </h6>
<form action="{{route('application.obtain')}}" method="post">
  @csrf
<table class="table table-striped marginbtm">
<th class="text-center"> Select Subjects Taken </th>
                  </table>
<table class="table table-bordered table-striped">

  <tr>
<th> </th>
<th> Major Subjects Taken </th>
  <th> Grade </th>

                  </tr>

<tbody>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Language And Literature </td>
                  <td><input type="text" style="width:40px;" value="{{$language}}"  name="language" id="lit" class="grade">  </td>

                  </tr>
                  <tr> 


<td><input type="checkbox" class="checksubject" name="checksubject"> </td>
<td> Applied English </td>
<td><input type="text" style="width:40px;" value="{{$english}}" name="english" id="eng" class="grade">  </td>

</tr>
<tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> General Mathemathics </td>
                  <td><input type="text" style="width:40px;" value="{{$maths}}" name="maths" id="math" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Economics </td>
                  <td><input type="text" style="width:40px;" value="{{$economics}}" name="economics" id="eco" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Accounting </td>
                  <td><input type="text" style="width:40px;" value="{{$accounting}}" name="accounting" id="account" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Business Studies </td>
                  <td><input type="text" style="width:40px;" value="{{$business}}" name="business" id="business" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Geography </td>
                  <td><input type="text" style="width:40px;" value="{{$geography}}" name="geography" id="geo" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> History </td>
                  <td><input type="text" style="width:40px;" value="{{$history}}" name="history" id="hist"  class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Legal Studies </td>
                  <td><input type="text" style="width:40px;" value="{{$legal}}" name="legal" id="legal" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Information Communication Technologies. </td>
                  <td><input type="text" style="width:40px;" value="{{$techno}}" name="techno" id="information" class="grade">  </td>

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


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Practical Skills </td>
                  <td><input type="text" style="width:40px;" value="{{$practical}}" name="practical" class="grade">  </td>

                  </tr>
                  <tr> 


<td><input type="checkbox" class="checksubject" name="checksubject"> </td>
<td> Home Economics  </td>
<td><input type="text" style="width:40px;" value="{{$home}}" name="home" class="grade[]">  </td>

</tr>
<tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Personal Development </td>
                  <td><input type="text" name="personal" value="{{$personal}}" style="width:40px;" class="grade[]">  </td>

                  </tr>
                </tbody>
                </table>
<button id="option" type="submit" class="btn btn-primary float-right btncolor"> obtain </button>   
</form>   
<br>
<br>
<form action="" method="POST">
<div class="card">
  <div class="card-body cardcolor">
    <div id="total"> GPA - {{$cgpa}}


     </div>
    <div>Attainment Points -  </div>
    <div>Eligibility -  </div>
    <div>Institute -  </div>
    <div>Programme/Course -  </div>
    
  </div>
</div>
<button value="sendel" type="submit" class="btn btn-primary btncolor">send-eligibility </button>
  <button value="saveandsend" type="submit" class="btn btn-primary  btncolor">save & Send-later </button>
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

  </style>

</html>   