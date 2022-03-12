<!DOCTYPE html>
<html>

<head>

    @include('admin.partials._header')

</head>

<body>
    <div id="wrapper">
        @include('admin.partials._sidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            @include('admin.partials._navbar')
        </div>

        @yield('content')


        @include('admin.partials._footer')

        
</body>
</html>
