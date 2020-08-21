<header class="main-header">
    <!-- Logo -->
    <a href="{{URL::to('admin/dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>{{@SITE_NAME}}</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{@SITE_NAME}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top header_controls">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{\Auth::guard('admin')->user()->profile_src}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucfirst(Auth::guard('admin')->user()->username) }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{\Auth::guard('admin')->user()->profile_src}}" class="img-circle" alt="User Image">

                <p>
                  {{ ucfirst(Auth::guard('admin')->user()->username) }}
                  <small>Member since {{ date('M, Y', strtotime(Auth::guard('admin')->user()->created_at)) }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{URL::to('/')}}/admin/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{URL::to('/')}}/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
<div class="flash-container">
@if(Session::has('message'))
  <div class="alert {{ Session::get('alert-class') }} text-center" style="margin-bottom:0px;" role="alert">
    {{ Session::get('message') }}
    <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
  </div>
@endif
<div class="alert alert-success text-center" id="success_message_div" style="margin-bottom:0px;display:none;" role="alert">
  <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
  <p id="success_message"></p>
  
</div>
<div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;display:none;" role="alert">
  <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
  <p id="error_message"></p>
</div>
</div>