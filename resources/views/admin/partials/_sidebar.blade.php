<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('admin/img') }}/profile_small.jpg" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ Auth::user()->fname }}
                            {{ Auth::user()->lname }}</span>
                        <span class="text-muted text-xs block">
                            @foreach (Auth::user()->roles as $role)
                                @if ($role->description == 'Superadmin')
                                    {{ 'Super Admin' }}
                                @else
                                    {{ $role->description }}
                                @endif
                            @endforeach
                            <b class="caret"></b>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a style="font-size: 12px; font-weight: 400" class="dropdown-item"
                                href="profile.html">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a style="color:#343a40; padding-bottom:10px" class="dropdown-item"
                                    href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="fa fa-sign-out"></i><b> {{ __('Log Out') }}</b>
                                </a>
                            </form>

                            {{-- <a class="dropdown-item" href="login.html">Logout</a></li> --}}
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="{{ url('dashboardNew') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Master Input
                    </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('cities') }}">Cities</a></li>
                    <li><a href="{{ url('area') }}">Areas</a></li>
                    <li><a href="{{ url('category') }}">Category</a></li>
                    <li><a href="{{ url('items') }}">Items</a></li>
                    <li><a href="{{ url('coupon') }}">Coupon</a></li>
                    <li><a href="vendors">Vendor</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('phoneOrder') }}"><i class="fa fa-flask"></i> <span class="nav-label">Phone
                        Order</span></a>
            </li>


            <li>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Order Manager</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('orderManagerList') }}">Order Manager</a></li>
                    <li><a href="{{ url('orderManager') }}">Add Order</a></li>
                    {{-- <li><a href="{{ url('collectionManager') }}">Payment</a></li> --}}
                    <li><a href="{{ url('paymentInfo') }}">Payment</a></li>
                    <li><a href="{{ url('collectionManager') }}">Collection</a></li>

                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">User Manager</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('userManagerList') }}">User List</a></li>
                    <li><a href="lockscreen.html">Lockscreen</a></li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Staff Manager</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('staffManagerList') }}">Staff List</a></li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Billing System</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="search_results.html">Search results</a></li>
                    <li><a href="lockscreen.html">Lockscreen</a></li>

                </ul>
            </li>
            <li>
                <a href="{{ url('vendors') }}"><i class="fa fa-flask"></i> <span class="nav-label">Vendor
                        Management</span></a>
            </li>
            <li>
                <a href="{{ url('vendors') }}"><i class="fa fa-flask"></i> <span class="nav-label">Expense
                        System</span></a>
            </li>
            <li>
                <a href="{{ url('vendors') }}"><i class="fa fa-flask"></i> <span class="nav-label">Discount &
                        Offer</span></a>
            </li>
            <li>
                <a href="{{ url('vendors') }}"><i class="fa fa-flask"></i> <span class="nav-label">Customer
                        Review System</span></a>
            </li>
            <li>
                <a href="{{ url('vendors') }}"><i class="fa fa-flask"></i> <span class="nav-label">Contact &
                        Feedback</span></a>
            </li>
            <li>
                <a href="{{ url('vendors') }}"><i class="fa fa-flask"></i> <span
                        class="nav-label">Reporting</span></a>
            </li>






        </ul>

    </div>
</nav>
