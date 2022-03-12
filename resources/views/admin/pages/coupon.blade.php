@extends('admin.app')

@section('title', 'Coupon')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2><b>Coupon</b></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('manage_coupon') }}" class="btn btn-sm btn-primary btn-outline float-right m-t-n-xs"
                        id="btn-add-city" type="submit">
                        Add Coupon
                    </a>
                </li>
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

    <div class="wrapper wrapper-content animated fadeInRight">
        <input type="hidden" id="city_id">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="orderDetailTable"
                                class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Value</th>
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
                                            <td>@php echo $i; @endphp.</td>
                                            <td>{{ $list->title }}</td>
                                            <td>{{ $list->code }}</td>
                                            <td>{{ $list->value }}</td>
                                            <td>
                                                <a href="{{ url('manage_coupon/') }}/{{ $list->id }}" id="edit_coupon"
                                                    class="btn btn-primary btn-sm btn-outline"><i
                                                        class="fa fa-edit"></i></a>&nbsp;&nbsp;<a
                                                    href="{{ url('delete/') }}/{{ $list->id }}"
                                                    class="btn btn-danger btn-sm btn-outline" id="btn-delete-coupon"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Value</th>
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
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#message').fadeOut();
            }, 3000);

        });
    </script>
@endsection
