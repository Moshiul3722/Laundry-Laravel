@extends('admin.app')

@section('title', 'Phone Order List')

@section('csslinks')

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Order Manager</h2>
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
                                    <tr class="text-center">
                                        <th>Sl No.</th>
                                        <th>Order Date</th>
                                        <th>Order No.</th>
                                        <th>Customer Name</th>
                                        <th>Contact No.</th>
                                        <th>Del City</th>
                                        <th>Del Area</th>
                                        <th>Pickup Date</th>
                                        <th>Pickup Time</th>
                                        <th>Status</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($userInfo as $user)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr class="gradeC text-center">
                                            <td width="60">@php echo $i; @endphp.</td>
                                            <td>
                                                {{-- {{ $user->created_at->toFormattedDateString() }} --}}
                                                {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ $user->orderNo }}</td>
                                            <td>
                                                {{ $user->fname }} {{ $user->lname }}<br>


                                                @if ($user->payment_type == 0)

                                                @else
                                                    <a href="#" data-id="{{ $user->user_id }}" id="customerDetails"
                                                        class="btn btn-xs btn-info mt-1">View
                                                        Address</a>
                                                @endif


                                            </td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->city_name }}</td>
                                            <td>{{ $user->area_name }}</td>
                                            <td>{{ $user->pick_up_date }}</td>
                                            <td>{{ $user->pick_up_time }}</td>
                                            <td>
                                                @if ($user->payment_type == 0)
                                                    <a href="orderDetail_orderManager/{{ $user->id }}"
                                                        class="btn btn-sm btn-info btn-outline">Add Details</a>
                                                @else
                                                    <a href="mange_itemProcess/{{ $user->id }}"
                                                        class="btn btn-w-m btn-info">Laundry</a>
                                                @endif
                                            </td>
                                            <td style="text-align: center">



                                                {{-- <a href="processManager/{{ $user->id }}"
                                                    class="btn btn-sm btn-warning btn-outline">In Process</a> --}}
                                                @if ($user->payment_type == 1)
                                                    <a href="checkoutManager/{{ $user->id }}"
                                                        class="btn btn-sm btn-success">Pay Now</a>
                                                @endif
                                                &nbsp;<a href="manage_orderManager/{{ $user->id }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="delete_orderManager/{{ $user->id }}"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                <input type="hidden" id="userID" name="userID" value="{{ $user->id }}">
                                            </td>
                                        </tr>


                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>Sl No.</th>
                                        <th>Order Date</th>
                                        <th>Order No.</th>
                                        <th>Customer Name</th>
                                        <th>Contact No.</th>
                                        <th>Del City</th>
                                        <th>Del Area</th>
                                        <th>Pickup Date</th>
                                        <th>Pickup Time</th>
                                        <th>Status</th>
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




    <div class="modal inmodal fade" id="customInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Customer Details</h4>

                </div>
                <div class="container">
                    <table>
                        <tr>
                            <td>
                                <h2>&nbsp;&nbsp;&nbsp;&nbsp;Name</h2>
                            </td>
                            <td>
                                <h2>:</h2>
                            </td>
                            <td>
                                <h2 id="custModalName">&nbsp;&nbsp;</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>&nbsp;&nbsp;&nbsp;&nbsp;Mobile No.</h2>
                            </td>
                            <td>
                                <h2>:</h2>
                            </td>
                            <td>
                                <h2 id="custModalMobile">&nbsp;&nbsp;</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>&nbsp;&nbsp;&nbsp;&nbsp;E-mail</h2>
                            </td>
                            <td>
                                <h2>:</h2>
                            </td>
                            <td>
                                <h2 id="custModalEmail">&nbsp;&nbsp;</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>&nbsp;&nbsp;&nbsp;&nbsp;Delivery Address</h2>
                            </td>
                            <td>
                                <h2>:</h2>
                            </td>
                            <td>
                                <h2 id="customModalDeliAdd"></h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>&nbsp;&nbsp;&nbsp;&nbsp;Order Date</h2>
                            </td>
                            <td>
                                <h2>:</h2>
                            </td>
                            <td>
                                <h2 id="customModalPicDate">&nbsp;&nbsp;
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>&nbsp;&nbsp;&nbsp;&nbsp;PickUp Time</h2>
                            </td>
                            <td>
                                <h2>:</h2>
                            </td>
                            <td>
                                <h2 id="customModalPicTime">&nbsp;&nbsp;</h2>
                            </td>
                        </tr>

                    </table>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('admin/js') }}/datatablescript.js"></script>


    <!-- Data picker -->
    <script src="{{ asset('admin/js') }}/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '#customerDetails', function() {
                // alert('picked Up Id -' + jQuery(this).data('id'));
                let customID = jQuery(this).data('id');

                $.ajax({
                    url: "customerInfo/" + customID,
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        $('#custModalName').html(response.data[0].fname + ' ' + response.data[0]
                            .lname)
                        $('#custModalMobile').html(response.data[0].phone)
                        $('#custModalEmail').html(response.data[0].email)
                        $('#customModalDeliAdd').html(response.data[0].customerAddress +
                            '<br>' + response.data[0].area_name + ', ' + response.data[0]
                            .city_name + '-' + response.data[0].postCode)
                        $('#customModalPicDate').html(response.data[0].pick_up_date)
                        $('#customModalPicTime').html(response.data[0].pick_up_time)
                        $('#customInfoModal').modal('show');
                    }
                });
            });

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
