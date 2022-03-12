@extends('admin.app')
@section('title', 'Dashboard')
@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="label label-success float-right">Monthly</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">40 886,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="label label-info float-right">Annual</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">275,800</h1>
                        <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="label label-primary float-right">Today</span>
                        <h5>visits</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">106,120</h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                        <small>New visits</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="label label-danger float-right">Low value</span>
                        <h5>User activity</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">80,600</h1>
                        <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                        <small>In first month</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h4>Order and Delivery</h4>
                        <div class="float-right">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="widget lazur-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Pick Up
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">5</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="widget navy-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Delivery
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">7</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h4>Customer Report</h4>
                        <div class="float-right">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="widget lazur-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    This Month
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">25</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="widget navy-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    This Year
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">128</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="widget yellow-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    All time
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">2020</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h4>Customer Report</h4>
                        <div class="float-right">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="widget lazur-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Pick Up
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">456</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="widget navy-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Pick Up
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">456</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="widget yellow-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Pick Up
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">456</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h4>Order Received</h4>
                        <div class="float-right">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="widget lazur-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Pick Up
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">456</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="widget navy-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <h2 class="dashboardInfoheading font-bold no-margins">
                                                    Todays Pick Up
                                                </h2>
                                                {{-- <i class="fa fa-shield fa-4x mt-2"></i> --}}
                                                <h1 class="dashboardInfoCount mt-4 mb-4">456</h1>
                                                <h3 class="font-bold no-margins">
                                                    <a class="dashboardInfoLinks" href="#">Click to View Details</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
