<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.partials._header')
    </head>

    <body>
        <!-- Top Bar Start -->
        @include('frontend.partials._topNavbar')
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        @include('frontend.partials._navbar')
        <!-- Nav Bar End -->


       @yield('homecontent')
        <!-- Blog End -->


        <!-- Footer Start -->
        @include('frontend.partials._footer')
       


    </body>
</html>
