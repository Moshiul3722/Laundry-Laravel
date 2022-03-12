<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>

{{-- ---------------Data Table --}}

<link href="{{ asset('admin/css') }}/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('admin/font-awesome') }}/css/font-awesome.css" rel="stylesheet">
<link href="{{ asset('admin/css') }}/plugins/dataTables/datatables.min.css" rel="stylesheet">
{{-- <link href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css" rel="stylesheet"> --}}



{{-- ------Extra links--------- --}}

{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> --}}

{{-- ----------End Extra links------------- --}}

<!-- Toastr style -->
<link href="{{ asset('admin/css') }}/plugins/toastr/toastr.min.css" rel="stylesheet">

<!-- Gritter -->
<link href="{{ asset('admin/js') }}/plugins/gritter/jquery.gritter.css" rel="stylesheet">

<link href="{{ asset('admin/css') }}/animate.css" rel="stylesheet">
<link href="{{ asset('admin/css') }}/style.css" rel="stylesheet">
<link href="{{ asset('admin/css') }}/drywashbd.css" rel="stylesheet">
@yield('csslinks')
