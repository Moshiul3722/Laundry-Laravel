@extends('admin.app')

@section('title', 'Order Management')

@section('csslinks')
    <link href="{{ asset('admin/css') }}/plugins/datapicker/datepicker3.css" rel="stylesheet">

    {{-- This script is using for timepicker --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link href="{{ asset('admin/lib') }}/tpicker.css" rel="stylesheet">
    <script src="{{ asset('admin/lib') }}/tpicker.js"></script>
@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Order Management</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('orderManagerList') }}" class="btn btn-primary pull-left btn-outline"
                        required="required">Order Manager List</a>

                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>




    <div class="wrapper wrapper-content animated fadeInRight">

        <form action="{{ url('editItemOrder/'.'1') }}" method="POST">
            @csrf
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <input type="hidden" id="itemId" name="itemId" value="{{ $result['order_detail_id'] }}">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label" for="selectPhoneNo">Customer Phone Number</label>
                            <select name="selectPhoneNo" class="form-control" id="selectPhoneNo" disabled
                                readonly="readonly">
                                <option value="0" selected disabled>--- Select Category ---</option>
                                @foreach ($phoneNos as $phone)
                                    @if ($result['user_id'] == $phone->id))
                                        <option value="{{ $phone->id }}" selected>{{ $phone->phone }}</option>
                                    @else
                                        <option value="{{ $phone->id }}">{{ $phone->phone }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {{-- <div class="form-group">
                        <label class="col-form-label" for="customerAddress">Customer Address</label>
                        <input type="text" id="customerAddress" name="customerAddress" value="{{ $result['customerAddress'] }}" placeholder="Enter Item name" readonly="readonly"
                            class="form-control">
                    </div> --}}
                    </div>


                    <div class="col-sm-4">
                        {{-- <div class="form-group">
                        <label for="itemPrice">Price</label>
                        <input type="number" min="0" id="itemPrice" name="itemPrice" value="" placeholder="Enter item price"
                            class="form-control">
                    </div> --}}
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="orderNo">Order No.</label>
                            <input type="text" id="orderNo" name="orderNo" placeholder="Order Number"
                                value="{{ $result['orderNo'] }}" readonly="readonly" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="customerName">Customer Name</label>
                            <input type="text" id="customerName" name="customerName" placeholder="Customer Name"
                                value="{{ $result['fname'] }} {{ $result['lname'] }}" readonly="readonly"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Customer E-mail</label>
                            <input type="email" id="email" name="email" value="{{ $result['email'] }}"
                                readonly="readonly" placeholder="Customer E-mail" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Select City</label>
                            <select class="form-control" id="selectCity" name="location_id" disabled>
                                <option value="0" selected disabled>--- Select City ---</option>
                                @foreach ($cities as $key => $city)
                                    <?php
                                    $strToArrCity = (array) $city;
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
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group" style="position: relative">
                            <label>Select Area</label>
                            <select class="form-control" name="area_id" disabled>
                                <option value="0" selected disabled>--- Select City ---</option>
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
                            {{-- <img id="loader" src="{{ asset('admin/img') }}/loader.gif" alt="Loading..." /> --}}
                        </div>
                    </div>
                    <div class="col-sm-4">

                        <div class="form-group" style="position: relative">
                            <label>Delivery Person</label>

                            <select name="selectStaff" class="form-control" id="selectStaff">
                                <option value="0" selected disabled>--- Select Delivery Person ---</option>

                                @foreach ($staffInfo as $key => $list)
                                    @php
                                        $strToArrList = (array) $list;
                                    @endphp

                                    @if ($result['staff_id'] == $strToArrList['id'])
                                        <option value="{{ $strToArrList['id']}}" selected>{{ $strToArrList['staff_name']}}</option>
                                    @else
                                        <option value="{{ $strToArrList['id']}}">{{ $strToArrList['staff_name']}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Pickup Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input id="pick-up-date" type="text" class="form-control"
                                            value="{{ $result['pick_up_date'] }}" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Select Time</label>

                                    <div style="">
                                        <input id="timepkr" name="timepkr" style="width:100px;float:left;"
                                            class="form-control" placeholder="HH:MM"
                                            value="{{ $result['pick_up_time'] }}" readonly="readonly" />
                                        <button type="button" class="btn btn-primary" onclick="showpickers('timepkr',24)"
                                            style="width:40px;">
                                            <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="timepicker"></div>
                                    <!--Important to add and keep it seprate to the end-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Delivery Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input id="delivery-date" name="deliveryDate" type="text" class="form-control"
                                            value="{{ $result['delivery_date'] }}" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Select Time</label>

                                    <div style="">
                                        <input id="timepkr2" name="timepkr2" style="width:100px;float:left;"
                                            class="form-control" placeholder="HH:MM"
                                            value="{{ $result['delivery_time'] }}"/>
                                        <button type="button" class="btn btn-primary" onclick="showpickers('timepkr2',24)"
                                            style="width:40px;">
                                            <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="timepicker"></div>
                                    <!--Important to add and keep it seprate to the end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col">
                    <div class="ibox">
                        <div class="ibox-content">

                            <div class="row">

                                <div class="col-sm-12" id="addItemSection">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fa fa-gift"></i> <b>Add Items</b>
                                            <div class="hr-line-dashed"></div>
                                        </div>

                                    </div>

                                    {{-- add more for Iron items --}}


                                    @php
                                        $loop_count_num = 1;
                                    @endphp
                                    @foreach ($orderItems as $key => $val)

                                        @php
                                            $items = (array) $val;

                                            // echo '<pre>';
                                            //     print_r($items);
                                            // die();

                                            $totalPrice = $items['price'] * $items['qty'];

                                            $loop_count_prev = $loop_count_num;
                                        @endphp

                                        <div class="row" id="add_item_detail_{{ $loop_count_num++ }}">
                                            <div class="col-sm-2">
                                                <div class="form-group" style="position: relative">
                                                    <label class="col-form-label" for="serviceCategory">Service
                                                        Category</label>
                                                    <select name="serviceCategory[]" id="serviceCategory0"
                                                        class="form-control" onchange="categoryItemChange(this.value, 0)">
                                                        <option value="0" selected disabled>--- Select Service Category ---
                                                        </option>
                                                        @foreach ($service_category as $category)

                                                            @if ($items['categories_id'] == $category->id)
                                                                <option value="{{ $category->id }}" selected>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="serviceItem">Select Item</label>
                                                    <select name="serviceItem[]" id="serviceItem0" class="form-control"
                                                        onchange="serviceItemChange(this.value, 0)">
                                                        <option value="0" selected disabled>--- Select Item ---</option>
                                                        @foreach ($service_items as $item)
                                                            @if ($items['item_id'] == $item->id)
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                    <img id="serviceloader0" src="{{ asset('admin/img') }}/loader.gif"
                                                        alt="Loading..." />
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="price">Price/Item</label>
                                                    <input type="text" id="price0" name="price[]"
                                                        value="{{ $items['price'] }}" placeholder="Price"
                                                        class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="product_qty">Qty</label>
                                                    <input type="number" id="product_qty0" name="product_qty[]" min="0"
                                                        value="{{ $items['qty'] }}" placeholder="0"
                                                        class="form-control" onkeyup="countPrice(0)">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="totalPrice">Total Price</label>
                                                    <input type="text" id="totalPrice0" name="totalPrice[]"
                                                        value="{{ $totalPrice }}" placeholder="T.Price"
                                                        class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="vendorArea">Vendor Area</label>
                                                    <select class="form-control m-b" name="vendorArea[]" id="vendorArea0"
                                                        onchange="vendorItemChange(this.value, 0)">
                                                        <option value="0" selected disabled>--- Select Vendor Area ---
                                                        </option>
                                                        @foreach ($areas as $venArea)
                                                            @if ($items['area_id'] == $venArea->id)
                                                                <option value="{{ $venArea->id }}" selected>
                                                                    {{ $venArea->area_name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $venArea->id }}">
                                                                    {{ $venArea->area_name }}
                                                                </option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="vendorName">Vendor Name</label>
                                                    <select class="form-control m-b large-bootstrap-select"
                                                        name="vendorName[]" id="vendorName0">
                                                        <option value="0" selected disabled>--- Select Vendor ---</option>
                                                        @foreach ($vendors as $vendor)
                                                            @if ($items['vendors_id'] == $vendor->id)
                                                                <option value="{{ $vendor->id }}" selected>
                                                                    {{ $vendor->ven_name }};
                                                                    Phone: {{ $vendor->ven_phone }} </option>
                                                            @else
                                                                <option value="{{ $vendor->id }}">
                                                                    {{ $vendor->ven_name }};
                                                                    Phone: {{ $vendor->ven_phone }} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <input type="hidden" name="id" value=""> --}}
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label class="col-form-label text-white btn-label-order-add-more"
                                                        for="price">AM</label>
                                                    @if ($loop_count_num == 2)
                                                        <button type="button" id="btn-add-more-items"
                                                            class="btn btn-info btn-outline btn-order-add-more"
                                                            onclick="add_more_item()"><i
                                                                class="fa fa-plus-circle"></i></button>
                                                    @else
                                                        <a
                                                            href="{{ url('remove_items/') }}/{{ $items['order_id'] }}/{{ $result['order_detail_id'] }}"><button
                                                                type="button" id="btn-remove-more-items"
                                                                class="btn btn-danger btn-outline btn-order-add-more"><i
                                                                    class="fa fa-minus-circle"></i></button></a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                {{-- End Iron Items --}}


                                <div class="col-sm-12">
                                    <div class="form-group">

                                        {{-- <a href="{{ url('viewOrderLists') }}" class="btn btn-info pull-left btn-outline"
            required="required">View Order List</a> --}}

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="addOrderDetails" class="btn btn-info btn-outline"
                                           >Edit Items</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        #serviceloader0 {
            position: absolute;
            width: 24px;
            right: 31px;
            top: 41px;
        }

    </style>
@endsection

@section('scripts')
    <!-- Data picker -->
    <script src="{{ asset('admin/js') }}/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="https://rawgit.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>

    {{-- jquery-editable-select --}}
    <link href="http://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css"
        rel="stylesheet">
 {{-- jquery-select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#selectStaff').select2();
        let loop_count = 1;

        function add_more_item() {
            loop_count++;
            var html = '<div class="row" id="add_item_detail_' + loop_count + '">';
            html +=
                '<div class="col-sm-2"><div class="form-group" style="position: relative"><label class="col-form-label" for="serviceCategory">Service Category</label><select name="serviceCategory[]" id="serviceCategory' +
                loop_count +
                '" onchange="categoryItemChange(this.value, loop_count)" class="form-control"><option value="0" selected disabled>--- Select Service Category ---</option> @foreach ($service_category as $category)<option value="{{ $category->id }}">{{ $category->name }}</option> @endforeach</select></div></div>';

            html +=
                '<div class="col-sm-2"><div class="form-group"><label class="col-form-label" for="serviceItem">Select Item</label><select name="serviceItem[]" id="serviceItem' +
                loop_count +
                '" class="form-control" onchange="serviceItemChange(this.value, loop_count)"><option value="0" selected disabled>--- Select Item ---</option>@foreach ($service_items as $item)<option value="{{ $item->id }}">{{ $item->name }}</option> @endforeach</select><img id="serviceloader' +
                loop_count + '" src="{{ asset('admin/img') }}/loader.gif" alt="Loading..." /></div></div>';


            html +=
                '<div class="col-sm-1"><div class="form-group"><label class="col-form-label" for="price">Price/Item</label><input type="text" id=price' +
                loop_count +
                ' name="price[]" value="" placeholder="Price" class="form-control" readonly="readonly">  </div></div> ';


            html +=
                '<div class="col-sm-1"><div class="form-group"><label class="col-form-label" for="product_qty">Qty</label><input onkeyup="countPrice(loop_count)" type="number" id=product_qty' +
                loop_count + ' name="product_qty[]" min="0" value="" placeholder="0" class="form-control"></div></div>';


            html +=
                '<div class="col-sm-1"><div class="form-group"><label class="col-form-label" for="totalPrice">Total Price</label><input type="text" id=totalPrice' +
                loop_count +
                ' name="totalPrice[]" value="" placeholder="T.Price" class="form-control" readonly="readonly"></div> </div>';


            html +=
                '<div class="col-sm-2"><div class="form-group"><label class="col-form-label" for="vendorArea">Vendor Area</label><select class="form-control m-b" name="vendorArea[]" id="vendorArea' +
                loop_count +
                ' "  onchange="vendorItemChange(this.value, loop_count)"> <option value="0" selected disabled>--- Select Vendor Area ---</option>@foreach ($areas as $venArea) <option value="{{ $venArea->id }}">{{ $venArea->area_name }} </option> @endforeach</select></div> </div>';


            html +=
                '<div class="col-sm-2"><div class="form-group"> <label class="col-form-label" for="vendorName">Vendor Name</label><select class="form-control m-b large-bootstrap-select" name="vendorName[]" id="vendorName' +
                loop_count +
                '"><option value="0" selected disabled>--- Select Vendor ---</option>@foreach ($vendors as $vendor)<option value="{{ $vendor->id }}">{{ $vendor->ven_name }};Phone: {{ $vendor->ven_phone }} </option> @endforeach</select></div></div>';

            html +=
                '<div class="col-sm-1"><div class="form-group"><label class="col-form-label text-white btn-label-order-add-more"for="price">AM</label><button type="button" id="btn-add-more-items" class="btn btn-danger btn-outline btn-order-add-more" onclick=remove_more_item("' +
                loop_count + '")><i class="fa fa-minus-circle"></i></button></div></div>';

            html += '</div>';

            // alert($("#product_qty").val());
            if ($("#serviceCategory0 option:selected").val() == 0) {
                toastr.warning('Please Select Service Category', 'Service Category is empty!!');
            } else if ($("#serviceItem0 option:selected").val() == 0) {
                toastr.warning('Please Select Service Item', 'Service Item is empty!!');
            } else if ($("#product_qty").val() == "undefined") {
                toastr.warning('Please enter Quantity', 'Quantity field is empty!!');
            } else {
                jQuery('#addItemSection').append(html);
            }

            //CSS for gif
            $("#serviceloader" + loop_count).css({
                "position": "absolute",
                "width": "24px",
                "right": "31px",
                "top": "41px"
            });

            $("#serviceloader" + loop_count).hide();
            $("#serviceItem" + loop_count).attr('disabled', 'disabled');
            $("#vendorName" + loop_count).attr('disabled', 'disabled');

        }

        // function remove_more_item(loop_count) {
        //     alert(loop_count);
        //     jQuery('#add_item_detail_' + loop_count).remove();
        // }

        function serviceItemChange(id, fieldId) {
            if (id) {
                // console.log("gfgfgfhh", fieldId);
                $.ajax({
                    url: "/getItemPriceByID/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let priceId = '#price' + fieldId
                        let productQtyId = '#product_qty' + fieldId
                        let totalPriceId = '#totalPrice' + fieldId
                        $(priceId).val(response[0].price);
                        $(productQtyId).val('');
                        $(totalPriceId).val('');
                    }
                });
            }
        }

        function countPrice(counter) {
            let priceId = '#price' + counter;
            let productQtyId = '#product_qty' + counter;
            let totalPriceId = '#totalPrice' + counter;
            let itemPrice = $(priceId).val();
            let itemQty = $(productQtyId).val();
            let totalPrice = itemPrice * itemQty;
            $(totalPriceId).val(totalPrice);
        }

        function categoryItemChange(id, fieldId) {

            var serviceLoader = $('#serviceloader' + fieldId),
                serviceCategory = $('#serviceCategory' + fieldId),
                serviceItem = $("#serviceItem" + fieldId);

            if (id) {
                serviceLoader.show();
                serviceItem.attr('disabled', 'disabled');
                $.ajax({
                    url: "/getServiceItem/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let sItem = '<option value="0" selected disabled>--- Select Item ---</option>';

                        response.forEach(function(row) {
                            sItem += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });

                        serviceItem.removeAttr("disabled");
                        serviceItem.html(sItem);
                        serviceLoader.hide();

                    }
                });
            }
        }


        function vendorItemChange(id, fieldId) {
            var vendorArea = $('#vendorArea' + fieldId),
                vendorName = $('#vendorName' + fieldId);

            if (id) {
                vendorName.attr('disabled', 'disabled');
                $.ajax({
                    url: "/getVendorByID/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let sVendor = '<option value="0">---Select Vendor---</option>';

                        response.forEach(function(row) {
                            sVendor += '<option value="' + row.id + '">' + row
                                .ven_name + ',' + row.ven_phone +
                                '</option>';
                        });

                        vendorName.removeAttr("disabled");
                        vendorName.html(sVendor);
                    }
                });
            }

        }


        $(document).ready(function() {
            $("#serviceloader0").hide();
            $("#serviceItem0").attr('disabled', 'disabled');
            $("#vendorName0").attr('disabled', 'disabled');

            $('#delivery-date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            // Get user information

            let user_id;
            $('#selectPhoneNo')
                .editableSelect()
                .on('select.editable-select', function(e, li) {
                    user_id = li.val();
                    // alert("ok");
                    $.ajax({
                        type: "GET",
                        url: "/getCustomerOrderInfo/" + user_id,
                        success: function(response) {
                            if (response.status == 400) {
                                //some staff goes here
                            } else {
                                console.log(response);
                                $('#orderNo').val(response.userInfo.orderNo);
                                $('#customerName').val(response.userInfo.fname + ' ' + response
                                    .userInfo.lname);
                                $('#email').val(response.userInfo.email);
                                $("#selectCity option:selected").text(response.userInfo.city_name);

                                if (response.userInfo.area_name) {
                                    // $('select[name="area_id"]').removeAttr("disabled");
                                    let area = '<option value="">' + response.userInfo.area_name +
                                        '</option>';
                                    $('select[name^="area_id"]').html(area);
                                }
                                // alert(response.userInfo.pick_up_date);
                                let getDate = response.userInfo.pick_up_date;
                                // let date = getDate.Format("dd/MM/yyyy");
                                $('#pick-up-date').val(getDate);
                                $('#timepkr').val(response.userInfo.pick_up_time);

                                // $("#pick-up-date").datepicker().datepicker("option", getDate, 'dd/mm/yyyy').datepicker("setDate");
                            }
                        }
                    });


                });

        });

        function remove_more_item(loop_count) {
            jQuery('#add_item_detail_' + loop_count).remove();
        }
    </script>
@endsection
