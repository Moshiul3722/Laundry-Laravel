<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="service.html" class="nav-item nav-link">Services</a>
                    <a href="price.html" class="nav-item nav-link">Prices</a>
                    <a href="location.html" class="nav-item nav-link">How it works</a>
                   
                    <a href="contact.html" class="nav-item nav-link">Special Offer</a>
                </div>
                <div class="navbar-nav ml-auto">
                    {{-- <a href="index.html" class="nav-item nav-link">Sign Up</a>
                    <a href="service.html" class="nav-item nav-link">Sign In</a> --}}
                    {{-- <a class="btn btn-custom" href="#">Get Appointment</a> --}}


                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline nav-text-color">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline nav-text-color">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 text-sm text-gray-700 underline nav-text-color">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif


                </div>
            </div>
        </nav>
    </div>
</div>
