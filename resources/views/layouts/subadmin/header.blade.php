<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
                  <img src="{{ asset("img/app-Icon.png") }}" class="center" width="100px">
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ auth('subadmin')->user()->profile_pic_path }}"  class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ auth('subadmin')->user()->user_name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        @include('layouts.subadmin.control-sidebar')
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth('subadmin')->user()->profile_pic_path }}" alt="">{{ auth('subadmin')->user()->first_name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{ route('subadmin.profile') }}">Account Profile</a></li>
                        <li><a href="{{ route('subadmin.change-password') }}">Change Password</a></li>
                        <li><a href="{{ route('subadmin.logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
