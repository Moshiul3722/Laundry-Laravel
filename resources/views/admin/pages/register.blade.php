@extends('admin.welcome')

@section('title', 'Register')
@section('csslinks')
    <link href="{{ asset('admin/css') }}/plugins/iCheck/custom.css" rel="stylesheet">
@endsection
@section('content')


    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>
                {{-- <h1 class="logo-name">Dry Wash BD</h1> --}}
            </div>
            <h3>Register to Dry Wash BD</h3>
            <p>Create account</p>
             <form method="POST" action="{{ route('register') }}">
            @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="First Name" required="" id="fname" name="fname">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Last Name" required="" id="lname" name="lname">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" id="email" name="email">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Phone" required="" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" id="password"
                        name="password" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" required="" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
            </form>
            {{-- <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> --}}
        </div>
    </div>


@endsection

{{-- @section('scripts')
    <!-- iCheck -->
    <script src="{{ asset('admin/js') }}/plugins/iCheck/icheck.min.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection --}}
