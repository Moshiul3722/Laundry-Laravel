<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li style="padding: 20px">
            <span class="m-r-sm text-muted welcome-message"><b>Welcome to Dry Wash Bangladesh</b></span>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i
                        class="fa fa-sign-out"></i><b> {{ __('Log Out') }}</b>
                </a>
            </form>
        </li>

    </ul>

</nav>
