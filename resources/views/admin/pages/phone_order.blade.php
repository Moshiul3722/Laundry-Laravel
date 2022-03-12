@extends('admin.app')

@section('title', 'Phone Order List')

@section('csslinks')
    <link href="{{ asset('admin/css') }}/plugins/datapicker/datepicker3.css" rel="stylesheet">

    {{-- This script is using for timepicker --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link href="{{ asset('admin/lib') }}/tpicker.css" rel="stylesheet">
    <script src="{{ asset('admin/lib') }}/tpicker.js"></script>
@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Phone Order</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('manage_phoneOrder') }}" class="btn btn-primary pull-left btn-outline"
                        required="required">Add
                        Order</a>
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

    {{-- Start Multi column form --}}

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
                                        <th>Customer Info</th>
                                        <th>Pickup Address</th>
                                        <th>Pickup Date & Time</th>
                                        <th>Required Service</th>
                                        <th>Payment Type</th>
                                        <th>Message</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($orderDetails as $orderDetail)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr class="gradeC">
                                            <td width="60">@php
                                                echo $i;
                                            @endphp.</td>
                                            <td>
                                                <label>Name:&nbsp;<b>{{ $orderDetail->fname }}&nbsp;{{ $orderDetail->lname }}</b>
                                                </label><br />
                                                <label>Phone:&nbsp;{{ $orderDetail->phone }}</label><br />
                                                <label>E-mail:&nbsp;{{ $orderDetail->email }}</label>
                                            </td>
                                            <td>
                                                <label>City:&nbsp;{{ $orderDetail->city_name }}</label><br />
                                                <label>Location:&nbsp;{{ $orderDetail->area_name }}</label><br />
                                                <label>Address:&nbsp;{{ $orderDetail->area_name }}</label>
                                            </td>
                                            <td>
                                                <label>Date:&nbsp;{{ $orderDetail->pick_up_date }}</label><br />
                                                <label>Time:&nbsp;{{ $orderDetail->pick_up_time }}
                                                    @php
                                                        if (empty($orderDetail->pick_up_time)) {
                                                            echo '------';
                                                        }
                                                    @endphp
                                                </label>
                                            </td>
                                            {{-- <td>{{ $orderDetail->required_services }} --}}
                                            <td>
                                                @php
                                                    $str = $orderDetail->required_services;
                                                    $serviceArray = explode(',', $str);
                                                    foreach ($serviceArray as $key => $value) {
                                                        switch ($value) {
                                                            case 1:
                                                                echo 'Iron <br>';
                                                                break;
                                                            case 2:
                                                                echo 'Wash & Iron <br>';
                                                                break;
                                                            case 3:
                                                                echo 'Dry Wash <br>';
                                                                break;
                                                        }
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ $orderDetail->pay_type }}</td>
                                            <td>{{ $orderDetail->message }}
                                                @php
                                                    if (empty($orderDetail->message)) {
                                                        echo 'No Message';
                                                    }
                                                @endphp

                                            </td>
                                            <td style="text-align: center">
                                                <button id="btn-picked-up" data-id="{{ $orderDetail->id }}"
                                                    class="btn btn-sm btn-info">Picked Up</button>
                                                <a href="manage_phoneOrder/{{ $orderDetail->id }}"
                                                    class="btn btn-sm btn-success"><i
                                                        class="fa fa-edit"></i></a>&nbsp;
                                                <a href="delete_phoneOrder/{{ $orderDetail->id }}"
                                                    class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Customer Info</th>
                                        <th>Pickup Address</th>
                                        <th>Pickup Date & Time</th>
                                        <th>Required Service</th>
                                        <th>Payment Type</th>
                                        <th>Message</th>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('admin/js') }}/plugins/datapicker/bootstrap-datepicker.js"></script>

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


            //picked up
            $(document).on('click', '#btn-picked-up', function() {
                // alert('picked Up Id -' + $(this).data('id'));
                swal({
                    title: "Are you sure?",
                    text: "You want to Picked Up this Order!!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('editNonPickedUpToPickedUp') }}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": $(this).data('id')
                            },
                            success: function(response) {
                                // location.reload(); //this reload the page
                                window.location.href = "{{ route('orderManagerList')}}";
                            }

                        });
                    } else {
                        swal("You Order in not Picked Up!!!");
                    }
                });
            });



        });
    </script>
@endsection
