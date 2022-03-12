@extends('admin.app')

@section('title', 'Phone Order List')

@section('csslinks')

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>User Manager</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-6">
            <label> </label>

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissable" id="message">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <b>{{ session('message') }}</b>
                </div>
            @endif
        </div>
    </div>

    {{-- Start Multi column form --}}



    {{-- <div class="form-group row"> --}}

    {{-- End Multi column form --}}

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">



                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                        <label> </label>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="orderDetailTable"
                                class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i = 0;
                                    @endphp

                                    @foreach ($data as $list)

                                        @php
                                            $i++;
                                        @endphp

                                        <tr>
                                            <td width="100">@php echo $i; @endphp.</td>
                                            <td>{{ $list->fname }} {{ $list->lname }}</td>
                                            <td>{{ $list->email }}</td>
                                            <td>{{ $list->phone }}</td>
                                            <td>{{ $list->roles }}</td>
                                            <td><a href="userProcess/{{ $list->user_id }}" class="btn btn-sm btn-success btn-outline"><i
                                                        class="fa fa-edit"></i></a>&nbsp;
                                                <a href="" class="btn btn-sm btn-danger btn-outline"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
    <script src="{{ asset('admin/js') }}/datatablescript.js"></script>

    <script>
        $(document).ready(function() {
            // $('.summernote').summernote();
            $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            setTimeout(function() {
                $('#message').fadeOut();
            }, 3000);
        });
    </script>


@endsection
