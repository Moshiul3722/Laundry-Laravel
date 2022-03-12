@extends('admin.app')

@section('title', 'Phone Order List')

@section('csslinks')

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Collection</h2>
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
                                        <th>Order Date</th>
                                        <th>Order No.</th>
                                        <th>Customer Info</th>
                                        <th>Grand Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        {{-- <th>Delivered By</th> --}}
                                        {{-- <th>Status</th> --}}
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp

                                    @foreach ($collectionInfo as $key => $val)

                                        @php
                                            $i++;
                                            $collection = (array) $val;
                                        @endphp

                                        <tr>
                                            <td width="60">@php echo $i; @endphp.</td>
                                            <td> {{ Carbon\Carbon::parse($collection['created_at'])->format('d-m-Y') }}
                                            </td>
                                            <td>{{ $collection['orderNo'] }}</td>
                                            <td>
                                                {{ $collection['fname'] }} {{ $collection['fname'] }}<br>
                                                {{-- Phone: {{ $collection['phone'] }}<br>
                                                E-mail: {{ $collection['email'] }} --}}
                                            </td>
                                            <td>{{ $collection['grandTotal'] }}</td>
                                            <td>{{ $collection['paid'] }}</td>
                                            <td>{{ $collection['due'] }}</td>
                                            {{-- <td>{{ $collection['staff_name'] }}</td> --}}
                                            {{-- <td>Active</td> --}}
                                            <td class="text-center">
                                                
 <a href="checkoutManager/{{ $collection['order_id'] }}" class="btn btn-w-m btn-info">Pay Now</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Order Date</th>
                                        <th>Order No.</th>
                                        <th>Customer Info</th>
                                        <th>Grand Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        {{-- <th>Delivered By</th> --}}
                                        {{-- <th>Status</th> --}}
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
        });
    </script>


@endsection
