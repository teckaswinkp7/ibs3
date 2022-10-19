@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  

    <div class="background-documents" style="margin-top:100px;"> 
        <div class="register-modal">
            <div class="register-logo">
                <a href="#"><img src="{{asset('assets/custom/New Project (14).png')}}" alt="" width="120px"></a>
            </div>  
            <h3>Submit your documents</h3>
            <form action="{{route('education.create.step.two.post')}}" method="POST" enctype="multipart/form-data" class="document-form">
                @csrf
                <p>Which is your highest qualification?</p>
                <div class="radio-documents row">
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="Grade 10">
                    <label>Grade 10</label>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="Certificate 3 or 4">
                    <label>Certificate 3 or 4</label>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="12th">
                    <label>Grade 12</label>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="qualification" value="Diploma / Bachelor">
                    <label>Certificate 3 or 4</label>
                </div>
                
                <div class="col-sm-12">
                    <input type="radio" name="qualification" value="Grade 12th Student">
                    <label>I'm a Grade 12th Student</label>
                </div>
                </div>
                <div class="upload-ps">
                    <input style="display:none" type="file" id="my-file" name="id_image">
                    <button type="button" onclick="document.getElementById('my-file').click()">Upload your passport size ID image</button>
                </div>
                <div class="upload-ps">
                    <input style="display:none" type="file" id="my-file-hq" name="highest_qualification">
                    <button type="button" onclick="document.getElementById('my-file-hq').click()">Upload your highest qualification</button>
                </div>
                <div class="upload-ps">
                    <input style="display:none" type="file" id="my-file-toc" name="course_syopsiy">
                    <button type="button" onclick="document.getElementById('my-file-toc').click()">Upload Transcripts or Course Synopsis ( for qualification higher than Grade 12)</button>
                </div>
                
                    
                
                <div class="documents-btn">
                    <button type="submit">Submit</button>
                </div>
          </form>
        </div>
    </div>
    @include('front/footer')  
    @endsection  