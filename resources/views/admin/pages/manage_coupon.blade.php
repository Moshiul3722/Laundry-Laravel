@extends('admin.app')

@section('title', 'Coupon')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2><b>Manage Coupon</b></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('coupon') }}" class="btn btn-sm btn-primary btn-outline float-right m-t-n-xs"
                        id="btn-add-city" type="submit">
                        Manage Coupon
                    </a>
                </li>
            </ol>
        </div>
        <div class="col-lg-6">



        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-content">

                        <form action="{{ route('coupon.manage_coupon_process') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}" />
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="title">Title</label>
                                <div class="col-lg-9">
                                    <input type="text" name="title" id="title" value="{{ $title }}"
                                        placeholder="Enter Coupon Title" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="code">Code</label>
                                <div class="col-lg-9">
                                    <input type="text" name="code" id="code" value="{{ $code }}"
                                        placeholder="Enter Coupon Code" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="value">Value</label>
                                <div class="col-lg-9">
                                    <input type="number" name="value" id="value" value="{{ $value }}"
                                        placeholder="Enter Coupon Value" class="form-control" required>
                                </div>
                            </div>

                            <div>
                                <button class="btn btn-sm btn-primary btn-outline float-right m-t-n-xs" type="submit">
                                    Add Coupon
                                </button>


                                <label> </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {




        });
    </script>
@endsection
