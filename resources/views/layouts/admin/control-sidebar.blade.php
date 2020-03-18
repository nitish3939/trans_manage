<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Navigation</h3>
    <div class="ln_solid"></div>
    <ul class="nav side-menu sidebar-scroll">
      <li>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
      </li>



<li @if(in_array(Route::currentRouteName(), ['admin.users.booking-create', 'admin.users.booking', 'admin.staff.edit', 'admin.staff.add','admin.staff.index','admin.users.add','admin.users.edit','admin.users.detail']))
{{ "class=active" }}
@endif>
<a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu"
@if(in_array(Route::currentRouteName(), ['admin.subadmin.edit', 'admin.subadmin.add', 'admin.subadmin.index', 'admin.users.booking-create', 'admin.users.booking', 'admin.staff.edit', 'admin.staff.add','admin.staff.index','admin.users.add','admin.users.edit','admin.users.detail']))
{{ "style=display:block;" }}
@endif
>

<li @if(in_array(Route::currentRouteName(), ['admin.staff.edit', 'admin.staff.add','admin.staff.index']))
{{ "class=current-page" }}
@endif
><a href="{{ route('admin.staff.index') }}">Staff</a></li>
<li @if(in_array(Route::currentRouteName(), ['admin.subadmin.edit', 'admin.subadmin.add', 'admin.subadmin.index']))
{{ "class=current-page" }}
@endif
><a href="{{ route('admin.subadmin.index') }}">Sub Admin</a></li>
</ul>
</li>
<li  @if(in_array(Route::currentRouteName(), ['admin.client.index']))
{{ "class=current-page" }}
@endif
>
<a href="{{ route('admin.client.index') }}"><i class="fa fa-user"></i>Client Management</a>
</li>
<li  @if(in_array(Route::currentRouteName(), ['admin.vehicle.index']))
{{ "class=current-page" }}
@endif
>
<a href="{{ route('admin.vehicle.index') }}"><i class="fa fa-truck"></i>Vehicle Management</a>
</li>
<li  @if(in_array(Route::currentRouteName(), ['admin.challan.index']))
{{ "class=current-page" }}
@endif
>
<a href="{{ route('admin.challan.index') }}"><i class="fa fa-files-o"></i>Challan Management</a>
</li>
<li  @if(in_array(Route::currentRouteName(), ['admin.trip.index']))
{{ "class=current-page" }}
@endif
>
<a href="{{ route('admin.trip.index') }}"><i class="fa fa-location-arrow"></i>Trip Management</a>
</li>
<li  @if(in_array(Route::currentRouteName(), ['admin.notification.index']))
{{ "class=current-page" }}
@endif
>
<a href="{{ route('admin.notification.index') }}"><i class="fa fa-newspaper-o"></i>Notification Management</a>
</li>

</ul>
</div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
<!--   <a data-toggle="tooltip" data-placement="top" title="Settings">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Lock">
    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a> -->
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin.logout') }}">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->
