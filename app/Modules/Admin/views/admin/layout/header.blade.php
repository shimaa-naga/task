<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <!--- custom nav---->
        <ul class="nav navbar-nav custom-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Categories </a>
                <ul class="dropdown-menu">

                @php
                    function getCategoryRecursive($category, $all, $child = false)
                    {
                        $title ="";
                        if ($child) {

                            $find =$all->where("id",$category->id)->first();
                            if($find!=null)
                            {
                                $title =$find->title ;
                            }

                        } else {
                            $title = $category->title;
                        }
                        $html = '';
                        $html .=
                            '<li><a class="dropdown-item" href="#">' .
                            $title .
                            '</a> ';
                            $children = $all->where("parent_id",$category->id);

                        if ($children->count() != 0) {
                            $html .= '<ul class="submenu dropdown-menu">';
                            foreach ($children as $child) {
                                $html .= getCategoryRecursive($child, $all, true);
                            }
                            $html .= '</ul>';
                        }

                        $html .= '</li>';
                        return $html;
                    }

                    echo '<li> <a class="dropdown-item" href="#"> ';
                    $all = \App\Bll\Lang::get_all_categories();
                    $main = $all->whereNull('parent_id');

                    foreach ($main as $category) {
                        echo getCategoryRecursive($category, $all);
                    }
                    echo '</a></li>';

                @endphp
                </ul>
{{--                <ul class="dropdown-menu">--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#"> Second level 1 </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#"> Second level 2 &raquo </a>--}}
{{--                        <ul class="submenu dropdown-menu">--}}
{{--                            <li>--}}
{{--                                <a class="dropdown-item" href=""> Third level 1</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="dropdown-item" href=""> Third level 3 &raquo </a>--}}
{{--                                <ul class="submenu dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href=""> Fourth level 1</a></li>--}}
{{--                                    <li><a class="dropdown-item" href=""> Fourth level 2</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </li>
        </ul>


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('admin_dashboard')}}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{auth()->guard('admin')->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('admin_dashboard')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                {{auth()->guard('admin')->user()->name}}
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
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
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="{{route('admin.logout')}}" ><i class="fa fa-sign-out"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

