<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Dashboard</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="{{asset('assets/admin/css/custom.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('assets/admin/css/adminlte.min.css')}}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
      <!-- JQVMap -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/jqvmap/jqvmap.min.css')}}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css')}}">
      <!-- DataTables -->
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
      <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
      <link href="{{asset('assets/admin/css/component-custom-switch.css')}}" rel="stylesheet" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <style>

#navbarNavDropdown li {
	border-right: 1px solid #4f4f4f;
  opacity:0.10px;
	}
  #navbarNavDropdown li:last-child {
	border-right: none
	}

  #vrline li{
    border-right: 1px solid #4f4f4f;
  opacity:0.10px;

  }
  #vrline li:last-child {
	border-right: none
	}

  .dropdown-header{

    color:orange!important;
  }

  .dropdown-header:hover{

    color:orange!important;
  }

  .dropdown-item{

    color:white;
  }

  .content-wrapper{

    margin-left:auto!important;
  }
 
</style>
    <body >  
        <!--<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="4s fa-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                       <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>-->
        <!--<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="#">Laravel</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>-->
        <nav class="navbar navbar-light btco-hover-menu">
        <div class="profile-logo">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="100px"></a>
        </div>  
        @php 

        $user = Auth::user();

        @endphp 
        <div class="row">
       <span class="nav-link"> Logged in as, {{$user->name}} </span> <a class="nav-link" href="{{ route('logout') }}">Logout</a>
</div>
</nav>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark btco-hover-menu">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <li class="nav-item">
                <a href="{{route('admin-dashboard')}}" class="nav-link {{ request()->is('admin-dashboard') ? 'active' : '' }}">
                  <p>
                    Dashboard
                  </p>
                </a>
            </li>
           
           <li class="nav-item dropdown">
           <a class="nav-link" data-toggle="dropdown" href="#"><p>Enrollment</p> </a>
           <div class="dropdown-menu navbar-dark dropdown-menu-lg dropdown-menu-left">
           <div class="container">
           <div class="row">
            <div class="col-md-6">
           <span class="dropdown-header">Schedule</span>
           
           <a href="#" class="dropdown-item">
          <p> Application </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Courseselection </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Offer </p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Enrollment </p>
               </a>
               <span class=" dropdown-header">Pay</span>
               <a href="#" class="dropdown-item">
          <p>Invoice </p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Payment</p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Reciept</p>
               </a>
</div>
<div class="col-md-6">
               <span class="dropdown-header">Manage Courses</span>
               <a href="#" class="dropdown-item">
          <p>Class Schedule </p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Study Venue </p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Study Plan</p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Attendance</p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Unit Enrollments</p>
               </a>
          </div>
</div>
</div>
</div>

          </li>
          <li class="nav-item dropdown">
           <a class="nav-link" data-toggle="dropdown" href="#"><p>Courses</p> </a>
           <div class="dropdown-menu navbar-dark dropdown-menu-lg dropdown-menu-left">
            
           <span class="dropdown-header">Programmes</span>
               <a href="#" class="dropdown-item">
          <p>Courses </p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Units</p>
               </a>
          
</div>
          </li>

          <li class="nav-item dropdown">
           <a class="nav-link" data-toggle="dropdown" href="#"><p>Reports</p> </a>
</div>
          </li>
          <div id="vrline">
          <li class="nav-item dropdown" >
           <a class="nav-link" data-toggle="dropdown" href="#"><p>Setup</p> </a>
           <div class="dropdown-menu navbar-dark dropdown-menu-lg dropdown-menu-left">
           <div class="container">
           <div class="row">
            <div class="col-md-6">
           <span class="dropdown-header">Manage Account</span>
           
           <a href="#" class="dropdown-item">
          <p> My Account </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Main Branding </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Sub Branding </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> System Defaults </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Alert Settings </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Billing Settings </p>
               </a>
               <a href="#" class="dropdown-item">
          <p> Templates </p>
               </a>
</div>
<div class="col-md-6">
               <span class="dropdown-header">Manage Users</span>
               <a href="#" class="dropdown-item">
          <p>Sales Executive</p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Enrolment </p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Admission</p>
               </a>
               <a href="#" class="dropdown-item">
          <p>Admin</p>
               </a>
          </div>
</div>
</div>
</div>
</div>

          </li>

        
         
                
           
        </ul>
</div>
        </nav>
        <!-- /.navbar -->  
    @yield('content')    
    