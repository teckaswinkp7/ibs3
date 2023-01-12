@extends('admin.header')  
@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1500px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary" href="{{route('application.index')}}"> Back</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update User</li>
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
               
                <form action="{{ route('enrollment.store') }}" method="POST" enctype="multipart/form-data" class="mb-0" id="catform">
                @csrf   
                
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
                                <input type="text" value="{{ $user->phone }}" name="phone" class="form-control"  readonly>
                              </div>
                            
</div>
<div class="col-md-8">
  
                    
                  @foreach ($student_edu as $user)
                  
                  
                      <?php 
                      $val = $user->id_image;
                      $ext = explode('.',$val);
                     // dd($val);
                      ?>
                    
                     
                     <embed src="{{url('public/Image')}}/{{ $user->id_image }}" height="500" width="800"> 
                     @endforeach       
                  
</div>
</div>

<div class="row">
  <div class="col-md-4">
<h6> Qualification Ranking </h6>
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
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


<td><input type="checkbox" class="checksubject" name="checksubject"> </td>
<td> Applied English </td>
<td><input type="text" style="width:40px;" class="grade">  </td>

</tr>
<tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> General Mathemathics </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Economics </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Accounting </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Business Studies </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Geography </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> History </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Legal Studies </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Information Communication Technologies. </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

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
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                  <tr> 


<td><input type="checkbox" class="checksubject" name="checksubject"> </td>
<td> Home Economics  </td>
<td><input type="text" style="width:40px;" class="grade">  </td>

</tr>
<tr> 


                  <td><input type="checkbox" class="checksubject" name="checksubject"> </td>
                  <td> Personal Development </td>
                  <td><input type="text" style="width:40px;" class="grade">  </td>

                  </tr>
                
                  





                  </tbody>
                </table>
                <div>
<button class="btn btn-primary float-right btncolor"> obtain </button>
</div>    
</div>            
<br>
<br>
<div class="col-md-8" style="margin-top:30px;">
<div class="card">
  <div class="card-body cardcolor">
    <p> GPA - </p>
    <p>Attainment Points -  </p>
    <p>Eligibility -  </p>
    <p>Institute -  </p>
    <p>Programme/Course -  </p>
    
  </div>

</div>
<button class="btn btn-primary  btncolor">send-eligibility </button>
  <button class="btn btn-primary  btncolor">save & Send-later </button>
</div>

                  </div>
</div>
               
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
  </style>
</html>   