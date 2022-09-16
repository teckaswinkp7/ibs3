<div class="col-lg-3">
  <div class="left-progress">
    <div class="mb-3" style="height:30px;">
      <div class="avatar-left">
        <img src="{{asset('assets/front/images/img_avatar.png')}}" alt="Image" class="avatar">
      </div>
      <div class="pname">
        <h4 class="mb-2 ml-3 profile-name">{{ ucwords(Auth::user()->name) }}</h4>
      </div>
    </div>
    <!-- Blue -->
    <div>
      <h4 class="mb-2 ml-1 profile-progress">Profile Progress</h4>
    </div>
    <div class="progress mt-3">
      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:40%">40%</div>
    </div>   
    @if (session('success'))
      <div class="alert alert-success">
      {{ session('success') }}
      </div>
    @endif
  </div> 
  <div class="accordion custom-margin" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">									
          <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <span><i class="fa fa-user"></i> Account</span>
            <i class="fa fa-chevron-down toggle"></i>
          </a>
        </h2>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <ul class="list-group">
          <li class="list-group-item"><a href="{{ route('dashboard') }}"><i class="fa fa-eye"></i> View Profile</a></li> 
          @if(Auth::user()->user_role == 2)  
          <li class="list-group-item"><a href="{{ route('education.create.step.one') }}"><i class="fa fa-pencil"></i> Edit Profile</a></li>                  
          <li class="list-group-item"><a href="{{ route('education.course.offer') }}"><i class="fa fa-graduation-cap"></i> Course Offer</a></li>
          @endif  
          @if(Auth::user()->user_role == 3)          
          <li class="list-group-item"><a href="{{ route('education.view.student') }}"><i class="fa fa-users"></i> View Student</a></li>
          <li class="list-group-item"><a href="{{ route('education.sponsored.student') }}"><i class="fa fa-hand-holding-dollar"></i> Sponsored Student</a></li>
          
          @endif 
          </ul>
        </div>
      </div>
    </div>

    
    <!--<div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">									
          <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <span><i class="fa fa-comments"></i> Messages</span>
          <i class="fa fa-chevron-down toggle rotate"></i>
          </a>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <ul class="list-group">
          <li class="list-group-item"><a href="#"><i class="fa fa-inbox"></i> Inbox <span class="badge badge-pill badge-primary">20</span></a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-paper-plane"></i> Sent</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-file-text"></i> Drafts <span class="badge badge-pill badge-info">15</span></a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-trash"></i> Trash</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h2 class="mb-0">									
          <a data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <span><i class="fa fa-bar-chart"></i> Reports</span>
          <i class="fa fa-chevron-down toggle"></i>
          </a>
        </h2>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
          <ul class="list-group">										
          <li class="list-group-item"><a href="#"><i class="fa fa-dollar"></i> Sales</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-tags"></i> Orders</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-plane"></i> Shipment</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-users"></i> Customers</a></li>										
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingFour">
        <h2 class="mb-0">									
        <a data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        <span><i class="fa fa-cog"></i> Settings</span>
        <i class="fa fa-chevron-down toggle"></i>
        </a>
        </h2> 
      </div>
      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
        <div class="card-body">
          <ul class="list-group">
          <li class="list-group-item"><a href="#"><i class="fa fa-font"></i> Typography</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-bell"></i> Notifications</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-map"></i> Maps</a></li>
          </ul>
        </div>
      </div>
    </div>-->
    <div class="card">
      <div class="card-header" id="headingFive">
      <h2 class="mb-0"><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></h2>
    </div>
  </div>
</div>
</div>