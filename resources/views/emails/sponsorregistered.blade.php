<!DOCTYPE html>
<html>
    <head> 
</head>
<body>
<h4> Hello,{!! $data['name'] !!} </h4>


<p> Please use the following credentials to access you IBSUniversity iConnect | Student’s Sponsor Portal.​ </p>

</br>
<h5>
<p> Username: {!! $data['email'] !!} </p> </br>
 <p> Password: {!! $data['password'] !!} </p>
</h5>

Login using: <a href="{{url('/sponsorlogin')}}"> Sponsor Login </a>

</body>

<footer>

</footer>

</html>