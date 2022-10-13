<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin-dashboard')}}" class="brand-link">
      <!--<img src="{{asset('assets/admin/img/IBS-Logo-Trans.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <span class="brand-text font-weight-light" style="margin-left:20px;"><b>IBS</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('assets/admin/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{route('dashboard')}}" class="d-block">Alexander Pierce</a>
            </div>
        </div>-->
        <!-- SidebarSearch Form -->
        <!--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
        <div class="sidebar-search-results">
            <div class="list-group">
                <a href="#" class="list-group-item">
                    <div class="search-title">
                        <strong class="text-light"></strong>N
                        <strong class="text-light"></strong>o
                        <strong class="text-light"></strong> 
                        <strong class="text-light"></strong>e
                        <strong class="text-light"></strong>l
                        <strong class="text-light"></strong>e
                        <strong class="text-light"></strong>m
                        <strong class="text-light"></strong>e
                        <strong class="text-light"></strong>n
                        <strong class="text-light"></strong>t
                        <strong class="text-light"></strong> 
                        <strong class="text-light"></strong>f
                        <strong class="text-light"></strong>o
                        <strong class="text-light"></strong>u
                        <strong class="text-light"></strong>n
                        <strong class="text-light"></strong>d
                        <strong class="text-light"></strong>!
                        <strong class="text-light"></strong>
                    </div>
                    <div class="search-path"></div>
                </a>
            </div>
        </div>
    </div>-->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{route('admin-dashboard')}}" class="nav-link {{ request()->is('admin-dashboard') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Role Management 
                    <!--<i class="fas fa-angle-left right"></i>-->
                    <i class="fas fa-angle-down"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item active">
                    <a href="{{route('role.index')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Role</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('role.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Role</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    User Management 
                   
                    <i class="fas fa-angle-down"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('user.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add User</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Category Management
                    <i class="fas fa-angle-down"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('categories.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Category</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Course Management &nbsp;&nbsp;&nbsp;
                    <i class="fas fa-angle-down"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('courses.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Course</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('courses.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Course</p>
                    </a>
                  </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                   Enrollment Officer 
                    <i class="fas fa-angle-down"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('enrollment.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Document Verification</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('screening.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Course Selection</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('studentcourse.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Send Offer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('studentcourse.viewOffer')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View Offer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('studentcourse.invoice')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Send Invoice</p>
                    </a>
                  </li>
                  
                </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                 Reports
                  <i class="fas fa-angle-down"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.reports.registeredstudents.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registered Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.reports.confirmedstudents.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Confirmed Students</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('studentcourse.viewInvoice')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Invoice</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('studentcourse.viewReceipt')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Receipt</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('reports.offerd')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Offer Generated</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('reports.invoice')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Invoice Generated</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('reports.documented')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Document Sent</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('reports.offer_accepted')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Offer Accepted</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('studentcourse.viewStudent')}}" class="nav-link">
                    <i class="nav-icon fas fa-usd"></i>
                    <p>
                     Payment Status                     
                    </p>
                  </a>                
              </li>
               </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('grade.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Grade                  
              </p>
            </a>             
          </li>
          <li class="nav-item">
            <a href="{{route('assignment.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Assignment                 
              </p>
            </a>              
          </li>
          <li class="nav-item">
            <a href="{{route('assignmentgrade.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Assignment Grade              
              </p>
            </a>              
          </li>
          <li class="nav-item">
            <a href="{{route('exam.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Exam          
              </p>
            </a>              
          </li>

            <li class="nav-item">
                <a href="{{route('bank.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-bank"></i>
                  <p>
                   Bank Details 
                    <!-- <i class="fas fa-angle-down"></i> -->
                  </p>
                </a>
                <!-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('enrollment.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Document Verification</p>
                    </a>
                  </li>                  
                </ul> -->
            </li>
            <li class="nav-item">
                <a href="{{route('sponsor.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-hand-holding-usd"></i>
                  <p>
                   Sponsor Details                     
                  </p>
                </a>                
            </li>
            
            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

