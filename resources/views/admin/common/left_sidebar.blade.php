<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="{{ (Route::current()->uri() == 'admin/dashboard') ? 'active' : ''  }}"><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'customers'))
          <li class="{{ (Route::current()->uri() == 'admin/customers') || (Route::current()->uri() == 'admin/add-customer') || (Route::current()->uri() == 'admin/edit-customer/{id}') || (Route::current()->uri() == 'admin/customer/properties/{id}')  ? 'active' : '' || (Route::current()->uri() == 'admin/customer/bookings/{id}')  ? 'active' : '' || (Route::current()->uri() == 'admin/customer/payouts/{id}')  ? 'active' : '' || (Route::current()->uri() == 'admin/customer/payment-methods/{id}')  ? 'active' : '' }}"><a href="{{ url('admin/customers') }}"><i class="fa fa-users"></i><span>Customers</span></a></li>
        @endif

        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'properties'))
          <li class="{{ (Route::current()->uri() == 'admin/properties') || (Route::current()->uri() == 'admin/add-properties') || (Route::current()->uri() == 'admin/listing/{id}/{step}') ? 'active' : ''  }}"><a href="{{ url('admin/properties') }}"><i class="fa fa-home"></i><span>Properties</span></a></li>
        @endif

        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_bookings'))
          <li class="{{ (Route::current()->uri() == 'admin/bookings') || (Route::current()->uri() == 'admin/bookings/detail/{id}') ? 'active' : ''  }}"><a href="{{ url('admin/bookings') }}"><i class="fa fa-shopping-cart"></i><span>Bookings</span></a></li>
        @endif
         
       {{-- When the penalty option is needed just uncomment these lines

        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_penalty'))
          <li class="treeview {{ (Route::current()->uri() == 'admin/guest_penalty' || Route::current()->uri() == 'admin/host_penalty') ? 'active' : ''  }}">
            <a href="#">
              <i class="fa fa-plane"></i> <span>Penalty</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="{{ (Route::current()->uri() == 'admin/guest_penalty') ? 'active' : ''  }}"><a href="{{ url('admin/guest_penalty') }}"><span>Guest Penalty</span></a></li>
              <li class="{{ (Route::current()->uri() == 'admin/host_penalty') ? 'active' : ''  }}"><a href="{{ url('admin/host_penalty') }}"><span>Host Penalty</span></a></li>
            </ul>
          </li>
        @endif  --}}

        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'view_payouts'))
          <li class="{{ (Route::current()->uri() == 'admin/payouts') ? 'active' : ''  }}"><a href="{{ url('admin/payouts') }}"><i class="fa fa-paypal"></i><span>Payouts</span></a></li>
        @endif
  
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_amenities'))
          <li class="{{ (Route::current()->uri() == 'admin/amenities') || (Route::current()->uri() == 'admin/add-amenities') || (Route::current()->uri() == 'admin/edit-amenities/{id}') ? 'active' : ''  }}"><a href="{{ url('admin/amenities') }}"><i class="fa fa-bullseye"></i><span>Amenities</span></a></li>
        @endif
       
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_pages'))
          <li class="{{ (Route::current()->uri() == 'admin/pages') || (Route::current()->uri() == 'admin/add-page') || (Route::current()->uri() == 'admin/edit-page/{id}') ? 'active' : ''  }}"><a href="{{ url('admin/pages') }}"><i class="fa fa-newspaper-o"></i><span>Static Pages</span></a></li>
        @endif
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_reviews'))
          <li class="{{ (Route::current()->uri() == 'admin/reviews') || (Route::current()->uri() == 'admin/edit_review/{id}') ? 'active' : ''  }}"><a href="{{ url('admin/reviews') }}"><i class="fa fa-eye"></i><span>Manage Reviews</span></a></li>
        @endif
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_messages'))
          <li class="{{ (Route::current()->uri() == 'admin/listing-message') ? 'active' : ''  }}"><a href="{{ url('admin/listing-message') }}"><i class="fa fa-user"></i><span>Listing messages</span></a></li>
        @endif
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_admin'))
          <li class="{{ (Route::current()->uri() == 'admin/admin-users') || (Route::current()->uri() == 'admin/add-admin') || (Route::current()->uri() == 'admin/edit-admin/{id}') ? 'active' : ''  }}">
            <a href="{{ url('admin/admin-users') }}">
              <i class="fa fa-user-plus"></i> <span>Users</span>
            </a>
          </li>
        @endif
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_messages'))
       <li class="{{ (Route::current()->uri() == 'admin/messages') || (Route::current()->uri() == 'admin/messaging/host/{id}') || (Route::current()->uri() == 'admin/send-message-email/{id}') ? 'active' : ''  }}">
            <a href="{{ url('admin/messages') }}">
            <i class="fa fa-user-plus"></i> <span>Messages</span>
            </a>
        </li>
        @endif
        <!-- Reporting segment -->
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'view_reports'))
          <li class="treeview {{ (Route::current()->uri() == 'admin/sales-report' || Route::current()->uri() == 'admin/sales-analysis' || Route::current()->uri() == 'admin/overview-stats') ? 'active' : ''  }}">
            <a href="#">
              <i class="fa fa-bar-chart-o"></i> <span>Reports</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="{{ (Route::current()->uri() == 'admin/overview-stats') ? 'active' : ''  }}"><a href="{{ url('admin/overview-stats') }}"><span>Overview & Stats</span></a></li>
              <li class="{{ (Route::current()->uri() == 'admin/sales-report') ? 'active' : ''  }}"><a href="{{ url('admin/sales-report') }}"><span>Sales Report</span></a></li>
              <li class="{{ (Route::current()->uri() == 'admin/sales-analysis') ? 'active' : ''  }}"><a href="{{ url('admin/sales-analysis') }}"><span>Sales Analysis</span></a></li>
            </ul>
          </li>
        @endif
        <!-- End of Reporting segment -->
        <!-- Email Template Starts -->
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
          <li class="{{ (Route::current()->uri() == 'admin/email-template/{id}') ? 'active' : ''  }}"><a href="{{ url('admin/email-template/1') }}"><i class="fa fa-envelope"></i><span>Email Templates</span></a></li>
        @endif
        <!-- Email Template Ends -->  
        @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'general_setting'))
        <li class="{{ (Request::segment(2) == 'settings') ? 'active' : ''  }}"><a href="{{ url('admin/settings') }}"><i class="fa fa-gears"></i><span>Settings</span></a></li>
        <!-- <li class="{{ (Route::current()->uri() == 'admin/settings') ? 'active' : ''  }}"><a href="{{ url('admin/settings') }}"><i class="fa fa-gears"></i><span>Settings</span></a></li> -->
        @endif

      </ul>
    </section>
    <!-- /.sidebar -->
</aside>