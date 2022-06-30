<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        @php
                        $username = App\Models\User::where('id',Auth::user()->id)->get();
                        @endphp
                        <a href="{!!url('admin/profile')!!}">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">Hi, {{ $username[0]->user_name }}</strong>
                                </span>
                            </span>
                        </a>
                    </span>
                </div>
            </li>

            <li title="Dashboard" class="{{ (Request::path() == 'admin/dashboard') ? 'active' : '' }}">
                <a href="{!!url('admin/dashboard')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li title="General Setting" class="{{ (Request::path() == 'admin/site_setting' || Request::path() == 'admin/profile' || Request::path() == 'admin/change_password') ? 'active' : '' }}">
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">General Setting</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ (Request::path() == 'admin/profile') ? 'active' : '' }}"><a href="{!!url('admin/profile')!!}">Profile</a></li>
                    <li class="{{ (Request::path() == 'admin/site_setting') ? 'active' : '' }}"><a href="{!!url('admin/site_setting')!!}">Site Setting</a></li>
                    <!-- <li class="{{ (Request::path() == 'admin/change_password') ? 'active' : '' }}"><a href="{!!url('admin/change_password')!!}">Change Password</a></li> -->
                </ul>
            </li>

            @if($username[0]->master_admin == 1)
            <li title="Admin Detail" class="{{ (Request::path() == 'admin/view-admin') ? 'active' : '' }}">
                <a href="{!!url('admin/view-admin')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">Add Admin</span></a>
            </li>
            @endif

            <li title="User Detail" class="{{ (Request::path() == 'admin/user-detail') ? 'active' : '' }}">
                <a href="{!!url('admin/user-detail')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">User</span></a>
            </li>

            <li title="Home Portal Section" class="{{ (Request::path() == 'admin/get-portal') ? 'active' : '' }}">
                <a href="{!!url('admin/get-portal')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">Home Portal Section</span></a>
            </li>
            <li title="Deine Section" class="{{ (Request::path() == 'admin/deine') ? 'active' : '' }}">
                <a href="{!!url('admin/deine')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">Deine Section</span></a>
            </li>
            <li title="Tippgeber-Portal Section" class="{{ (Request::path() == 'admin/tippgeber-portal') ? 'active' : '' }}">
                <a href="{!!url('admin/tippgeber-portal')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">Tippgeber-Portal Section</span></a>
            </li>
            <li title="Home Slider Section" class="{{ (Request::path() == 'admin/home-slider') ? 'active' : '' }}">
                <a href="{!!url('admin/home-slider')!!}"><i class="fa fa-th-large"></i> <span class="nav-label">Home Slider</span></a>
            </li>

            <li title="Pages Content" class="{{ (Request::path() == 'admin/home_page' || Request::path() == 'admin/so_einfach' || Request::path() == 'admin/faq' || Request::path() == 'admin/contact' || Request::path() == 'admin/page-content') ? 'active' : '' }}">
                <a href="javascript:;"><i class="fa fa-th-large"></i> <span class="nav-label">Pages Content</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ (Request::path() == 'admin/home_page') ? 'active' : '' }}">
                        <a href="{!!url('admin/home_page')!!}"> <span class="nav-label">Home Content</span></a>
                    </li>
                    <li class="{{ (Request::path() == 'admin/so_einfach') ? 'active' : '' }}">
                        <a href="{!!url('admin/so_einfach')!!}"> <span class="nav-label">So Einfach Geht's</span></a>
                    </li>
                    <li class="{{ (Request::path() == 'admin/faq') ? 'active' : '' }}">
                        <a href="{!!url('admin/faq')!!}"> <span class="nav-label">FAQ</span></a>
                    </li>
                    <li class="{{ (Request::path() == 'admin/page-content') ? 'active' : '' }}">
                        <a href="{!!url('admin/page-content')!!}"> <span class="nav-label">Page Content</span></a>
                    </li>
                    <!-- <li class="{{ (Request::path() == 'admin/change_password') ? 'active' : '' }}"><a href="{!!url('admin/change_password')!!}">Change Password</a></li> -->
                </ul>
            </li>



            <li class="Logout">
                <a href="{!!url('admin/logout')!!}"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
            </li>
        </ul>
    </div>
</nav>
