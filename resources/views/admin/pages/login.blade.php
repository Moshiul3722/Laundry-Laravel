@extends('admin.welcome')

@section('title', 'Login')

@section('content')


    <div class="loginColumns animated fadeInDown">
        <div class="row">


            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />


            <div class="col-md-6">
                <h2 class="font-bold">Welcome to Dry Wash Bangladesh</h2>
                <img alt="image" style="width: 100%; height: auto;" class="" src="
                    {{ asset('admin/img') }}/washing-vector-images.png" />

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" name="email" :value="old('email')"
                                placeholder="E-mail" required="">
                        </div>
                        <div class="form-group">
                            <input id="password" class="form-control block mt-1 w-full" type="password" name="password"
                                required autocomplete="current-password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif


                        <p class="text-muted text-center">
                            Do not have an account?
                        </p>
                        <a class="btn btn-white btn-block" href="{{ route('register') }}">Create an account</a>
                    </form>
                    {{-- <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p> --}}
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                Copyright
            </div>
            <div class="col-md-6 text-right">
                <small>© 2021-2022</small>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {




        });
    </script>
@endsection
