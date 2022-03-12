@extends('admin.app')

@section('title', 'Phone Order')

@section('csslinks')
    <link href="{{ asset('admin/css') }}/plugins/datapicker/datepicker3.css" rel="stylesheet">

    {{-- This script is using for timepicker --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link href="{{ asset('admin/lib') }}/tpicker.css" rel="stylesheet">
    <script src="{{ asset('admin/lib') }}/tpicker.js"></script>

    <link href="{{ asset('admin/css') }}/plugins/iCheck/custom.css" rel="stylesheet">
    {{-- <link href="{{ asset('admin/css') }}/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> --}}
@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Phone Order</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('phone_order') }}" class="btn btn-sm btn-primary btn-outline" id="btn-add-city"
                        type="submit">
                        View Order List
                    </a>

                </li>
            </ol>
        </div>
        <div class="col-lg-4">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <form action="{{ route('manage_phoneOrder') }}" method="post">

                            @csrf

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="">Customer Phone Number</label>
                                        <select class="
                                            form-control"
                                            id="selectPhoneNo" name="phoneNo">
                                            <option value="0" selected disabled>--- Select Phone No ---</option>
                                            @foreach ($phoneNos as $phone)
                                                @if ($result['user_id'] == $phone->id)
                                                    <option value="{{ $phone->id }}" selected>{{ $phone->phone }}
                                                    </option>
                                                @else
                                                    <option value="{{ $phone->id }}">{{ $phone->phone }}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="customerName">Customer Name</label>
                                        <input type="text" id="customerName" name="customerName"
                                            value="{{ $result['fname'] }}" placeholder="Enter Customer Name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Customer E-mail</label>
                                        <input type="email" id="email" name="email" value="{{ $result['email'] }}"
                                            placeholder="Enter Customer E-mail" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Pickup Date</label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" id="pickUpDate" name="pickUpDate"
                                                        value="{{ $result['pick_up_date'] }}" class="form-control"
                                                        data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Select Time</label>

                                                <div style="">
                                                    <input id="timepkr" name="timepkr" style="width:100px;float:left;"
                                                        class="form-control" placeholder="HH:MM"
                                                        value="{{ $result['pick_up_time'] }}" />
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="showpickers('timepkr',24)" style="width:40px;">
                                                        <i class="fa fa-clock-o"></i>
                                                </div>
                                                <div class="timepicker"></div>
                                                <!--Important to add and keep it seprate to the end-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="">Select City</label>
                                        <select class="
                                            form-control"
                                            id="selectCity" name="location_id">
                                            <option value="0" selected disabled>--- Select City ---</option>
                                            @foreach ($cities as $key => $city)
                                                <?php

                                                $strToArrCity = (array) $city;
                                                // echo '<pre>';
                                                //     dd(print_r($city));
                                                ?>
                                                @if ($result['city_id'] == $strToArrCity['id'])
                                                    <option value="{{ $strToArrCity['id'] }}" selected>
                                                        {{ $strToArrCity['city_name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $strToArrCity['id'] }}">
                                                        {{ $strToArrCity['city_name'] }}</option>
                                                @endif

                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group" style="position: relative">
                                        <label>Select Area</label>
                                        <select class="form-control" id="selectedArea" name="area_id">

                                            @foreach ($areas as $key => $area)
                                                @php
                                                    $strToArrArea = (array) $area;
                                                @endphp
                                                @if ($result['area_id'] == $strToArrArea['id'])
                                                    <option value="{{ $strToArrArea['id'] }}" selected>
                                                        {{ $strToArrArea['area_name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $strToArrArea['id'] }}">
                                                        {{ $strToArrArea['area_name'] }}</option>
                                                @endif

                                            @endforeach

                                        </select>
                                        <img id="loader" src="{{ asset('admin/img') }}/loader.gif" alt="Loading..." />

                                    </div>

                                    <div class="form-group">
                                        <label for="customerName">ZIP Code/Post Code</label>
                                        <input type="text" id="postCode" name="postCode"
                                            value="{{ $result['postCode'] }}" placeholder="Enter Customer Name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerAddress">Customer Address</label>
                                        <textarea id="customerAddress" name="customerAddress"
                                            placeholder="Enter Customer Address"
                                            class="form-control">{{ $result['customerAddress'] }} </textarea>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label for="cityname">Check Required Services</label>

                                        @php
                                            $str = $result['required_services'];
                                            $serviceArray = explode(',', $str);
                                        @endphp

                                        <div class="form-check">

                                            <label class="checkbox-inline i-checks" for="ironCheckbox">
                                                <input class="checkService form-check-input" type="checkbox"
                                                    id="ironCheckbox" name="services[]" value="1"
                                                    {{ (is_array($serviceArray) and in_array(1, $serviceArray)) ? ' checked' : '' }}>
                                                Iron </label>
                                            <label class="i-checks">
                                                <input class="checkService form-check-input" name="services[]"
                                                    type="checkbox" value="2 " id="washIronCheckbox"
                                                    {{ (is_array($serviceArray) and in_array(2, $serviceArray)) ? ' checked' : '' }}>
                                                Wash & Iron
                                            </label>
                                            <label class="i-checks">
                                                <input class="checkService form-check-input" name="services[]"
                                                    type="checkbox" value="3 " id="dryWashCheckbox"
                                                    {{ (is_array($serviceArray) and in_array(3, $serviceArray)) ? ' checked' : '' }}>
                                                Dry Wash
                                            </label>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="cityname">Payment Type</label>
                                        <div class="form-check">
                                            <label class="i-checks">
                                                <input class="form-check-input" type="radio" name="cashRadio" value="Cash"
                                                    id="cashRadio" {{ $result['pay_type'] == 'Cash' ? ' checked' : '' }}>
                                                <i></i> Cach </label>

                                            <label class="i-checks">
                                                <input class="form-check-input" type="radio" name="cashRadio" id="cashRadio"
                                                    value="Bkash" {{ $result['pay_type'] == 'Bkash' ? ' checked' : '' }}>
                                                <i></i> BKash </label>

                                            <label class="i-checks">
                                                <input class="form-check-input" type="radio" name="cashRadio" value="Rocket"
                                                    id="cashRadio"
                                                    {{ $result['pay_type'] == 'Rocket' ? ' checked' : '' }}>
                                                <i></i> Rocket </label>

                                            <label class="i-checks">
                                                <input class="form-check-input" type="radio" name="cashRadio" value="Nagad"
                                                    id="cashRadio"
                                                    {{ $result['pay_type'] == 'Nagad' ? ' checked' : '' }}>
                                                <i></i> Nagad </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col">
                                    <input type="hidden" name="id" value="{{ $result['id'] }}">
                                    <div class=" form-group">

                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" name="message" class="form-control"
                                            rows="5">{{ $result['message'] }}</textarea>
                                    </div>
                                    <button id="btnOrder" class="btn btn-sm btn-primary btn-outline" type="submit">
                                        Add Order
                                    </button>

                                    <label> </label>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #loader {
            position: absolute;
            width: 24px;
            right: 20px;
            top: 32px;
        }

    </style>
@endsection

@section('scripts')

    <!-- Data picker -->
    <script src="{{ asset('admin/js') }}/plugins/datapicker/bootstrap-datepicker.js"></script>

    {{-- jquery-editable-select js --}}
    <script src="https://rawgit.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>

    {{-- jquery-editable-select css --}}
    <link href="http://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css"
        rel="stylesheet">
    <!-- iCheck -->
    <script src="{{ asset('admin/js') }}/plugins/iCheck/icheck.min.js"></script>

    <script>
        var today = new Date();
        // var time = today.getHours() + ":" + today.getMinutes();


        var hours = today.getHours();
        var minutes = today.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        // var strTime = hours + ':' + minutes + ' ' + ampm;
        var strTime = hours + ':' + minutes;

        document.getElementById("timepkr").value = strTime;

        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#pickUpDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                clearBtn: true,
            });

            var selectedPhone = $('#selectPhoneNo').val();

            if (selectedPhone > 0) {
                $("#btnOrder").html("Edit Order");
            }

            $('#pickUpDate').datepicker('setDate', 'today');

            let user_id;
            $('#selectPhoneNo')
                .editableSelect()
                .on('select.editable-select', function(e, li) {
                    user_id = li.val();

                    $.ajax({
                        type: "GET",
                        url: "/getCustomerInfo/" + user_id,
                        success: function(response) {
                            if (response.status == 400) {
                                //some staff goes here
                            } else {
                                console.log(response);

                                $('#customerName').val(response.userInfo.fname + ' ' + response
                                    .userInfo.lname);
                                $('#email').val(response.userInfo.email);
                                // $("#selectCity option:selected").text(response.userInfo.city_name);

                                // if (response.userInfo.area_name) {
                                //     $('select[name="area_id"]').removeAttr("disabled");
                                //     let area = '<option value="">' + response.userInfo.area_name +
                                //         '</option>';
                                //     $('select[name^="area_id"]').html(area);
                                // }
                            }
                        }
                    });


                });



            //Cascade dropdown list
            let loader = $('#loader'),
                location = $('select[name="location_id"]'),
                area = $('select[name="area_id"]');

            loader.hide();
            // area.attr('disabled', 'disabled');

            area.change(function() {
                var id = $(this).val();
                if (!id) {
                    area.attr('disabled', 'disabled')
                }
            });

            location.change(function() {
                let id = $(this).val();
                if (id) {
                    loader.show();
                    // area.attr('disabled', 'disabled');

                    $.get('{{ url('/getOrderArea?location_id=') }}' + id).then(successCallback,
                        errorCallback);

                    function successCallback(response) {
                        let area = '<option value="0">---Select Area---</option>';
                        response.forEach(function(row) {
                            area += '<option value="' + row.id + '">' + row.area_name + '</option>';
                        });
                        // area.removeAttr('disabled');
                        $('select[name="area_id"]').removeAttr("disabled");
                        $('select[name="area_id"]').html(area);
                        loader.hide();
                    }

                    function errorCallback(error) {
                        //error code
                    }
                }
            });

        });
    </script>
@endsection
