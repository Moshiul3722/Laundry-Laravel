@extends('admin.app')

@section('title', 'Checkout')

@section('csslinks')

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Checkout</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight checkOutBottomPadding">
        <div class="row">
            <div class="col">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="checkoutTopTitle">Order No.</td>
                                    <td class="checkoutTopDesc">
                                        <h1 class="font-bold">{{ $user_order_details[0]->orderNo }}</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Customer Name: </td>
                                    <td>{{ $user_order_details[0]->fname }}
                                        {{ $user_order_details[0]->lname }}

                                        <input id="user_id" type="hidden" value="{{ $user_order_details[0]->user_id }}"
                                            class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td>{{ $user_order_details[0]->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>
                                        {{ $user_order_details[0]->phone }}

                                    </td>
                                </tr>
                            </table>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="ibox">
                    <div class="ibox-content">

                        <table width=400>
                            <tr>
                                <td>
                                    <h3>Due:</h3>
                                </td>
                                <td>
                                    @php
                                        if (empty($checkoutInfo[0]->due)) {
                                            echo '<h2 class="font-bold" id="due">' . $order_detail_total[0]->grandTotal . ' Tk. </h2>';
                                        } else {
                                            echo '<h2 class="font-bold" id="due3">' . $checkoutInfo[0]->due . ' Tk. </h2>';
                                        }
                                    @endphp
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>
                                    <h3>Collected By:</h3>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select name="selectStaff" class="form-control" id="selectStaff">
                                            <option value="0" selected disabled>--- Select City ---</option>
                                            @foreach ($staffInfo as $list)
                                                <option value="{{ $list->id }}">{{ $list->staff_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </td>
                            </tr> --}}
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="col">

                            <label style="text-align: center" class="col-form-label" for="product_name">
                                <h4>Payment Type</h4>
                            </label>
                            <div class="row">
                                <div class="col-sm-7">

                                    <div class="table-responsive">
                                        <table class="table shoping-cart-table">

                                            <tbody>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th style="text-align: right; width: 100">Price</th>
                                                    <th style="text-align: center;" width="200">Action</th>
                                                </tr>
                                                @php
                                                    $totalPrice = 0;
                                                @endphp

                                                @foreach ($orderItems as $key => $val)
                                                    @php
                                                        $items = (array) $val;
                                                        $totalPrice = $totalPrice + $items['price'] * $items['qty'];
                                                    @endphp

                                                    <tr>
                                                        <td class="desc">
                                                            <h3>
                                                                <a href="#" class="text-navy">
                                                                    {{ $items['item_name'] }}
                                                                </a>

                                                            </h3>
                                                            <div class="m-t-sm">
                                                                <a href="#" class="text-muted"><i
                                                                        class="fa fa-gift"></i>
                                                                    {{ $items['category_name'] }}</a>
                                                                |
                                                                <a href="#" class="text-muted"><i
                                                                        class="fa fa-trash"></i>
                                                                    Remove item</a>
                                                            </div>
                                                        </td>
                                                        <td width="50">
                                                            <input id="qty_{{ $items['order_id'] }}" type="number"
                                                                value="{{ $items['qty'] }}" class="form-control"
                                                                placeholder="1"
                                                                onchange="updateqty({{ $items['order_id'] }},{{ $items['qty'] }},{{ $items['price'] }},{{ $items['order_details_id'] }})">

                                                            <input id="order_details_id" type="hidden"
                                                                value="{{ $items['order_details_id'] }}"
                                                                class="form-control">
                                                            <input type="hidden" value="{{ $items['order_id'] }}"
                                                                class="form-control">
                                                        </td>
                                                        <td id="total_price_{{ $items['order_id'] }}" width="100">
                                                            {{ $items['price'] * $items['qty'] }} Tk.
                                                        </td>

                                                        <td width="200" style="text-align: center;">
                                                            <a href="#"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-5">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Order Summery</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td><span>Total</span></td>
                                                <td>
                                                    @php
                                                        if (empty($checkoutInfo[0]->grandTotal)) {
                                                            echo ' <h4 class="font-bold" id="total_price"></h4>';
                                                        } else {
                                                            echo '<h4 class="font-bold" id="totalPrice">' . $checkoutInfo[0]->grandTotal . ' Tk.</h4>';
                                                        }
                                                    @endphp

                                                </td>
                                            </tr>

                                            <tr>
                                                @php
                                                    if (empty($checkoutInfo[0]->paid)) {
                                                        echo '<td><span>Grand Total</span></td><td><h2 class="font-bold" id="grand_total"></h2></td>';
                                                    } else {
                                                        echo '<td><span>Prev. Due</span></td><td><h2 class="font-bold" id="prev_due">' . $checkoutInfo[0]->due . ' Tk.</h2></td>';
                                                    }
                                                @endphp


                                            </tr>
                                            <tr>
                                                <td><span>Pay Now</span></td>
                                                <td>
                                                    {{-- <h4 class="font-bold">$390,00</h4> --}}
                                                    <input style="width: 40%" id="pay_now" type="number" value=""
                                                        class="form-control">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span>Due</span></td>
                                                <td>
                                                    <h4 class="font-bold" id="due2">00.0 Tk.</h4>

                                                </td>
                                            </tr>
                                        </table>
                                        <hr>

                                    </div>


                                    <div class="m-t-sm">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-primary btn-sm" onclick="addCheckoutDetail()"><i
                                                    class="fa fa-shopping-cart"></i>
                                                PickUp Checkout</a>
                                            <a href="{{ url('orderManagerList') }}" class="btn btn-white btn-sm">
                                                Cancel</a>
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

    <style>
        td.checkoutTopTitle {
            width: 20%;
        }

        td.checkoutTopDesc {}

        #due,
        #due2,
        #due3 {
            color: red;
        }

    </style>
@endsection

@section('scripts')
    <script src="{{ asset('admin/js') }}/datatablescript.js"></script>
    <!-- Data picker -->
    <script src="{{ asset('admin/js') }}/plugins/datapicker/bootstrap-datepicker.js"></script>




    <script>



        function updateqty(order_id, qty, price, order_detail_id) {
            var qty = jQuery('#qty_' + order_id).val();

            var data = {
                _token: "{{ csrf_token() }}",
                qty: qty,
                order_detail_id: order_detail_id,
                order_id: order_id
            }

            $.ajax({
                url: "/updateCheckoutQty/" + order_id,
                type: 'post',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response.data[0].qty);
                    jQuery('#total_price_' + order_id).html(qty * price + ' Tk.');

                }
            });


            $.ajax({
                url: "/getTotalPrice/" + order_detail_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response.data);
                    let totalPrice = 0;
                    response.data.forEach(function(row) {
                        totalPrice += row.orderRate;
                    });
                    console.log(totalPrice);
                    $('#total_price').html(totalPrice + ' Tk.');
                    $('#grand_total').html(totalPrice + ' Tk.');
                }
            });
        }


        function addCheckoutDetail() {

            // var user_id = jQuery('#user_id').val();
            // var order_details_id = jQuery('#order_details_id').val();
            let total = parseInt($('#total_price').html());
            // let pnow = $('#pay_now').val();
            let due = parseInt($('#due2').html());
            // let order_detail_id = $('#order_details_id').val();

            //  gtotal: parseInt($('#grand_total').html()),
            let finalTotlal = '';
            let grandTotal = parseInt($('#grand_total').html());
            let prev_due = parseInt($('#prev_due').html());
            if (grandTotal == total) {
                finalTotlal = grandTotal;
            } else {
                finalTotlal = prev_due;
            }
            // var staffId = $('#selectStaff').find(":selected").val();
            // alert(staffId);


            var data = {
                _token: "{{ csrf_token() }}",
                user_id: jQuery('#user_id').val(),
                order_details_id: jQuery('#order_details_id').val(),
                gtotal: finalTotlal,
                pnow: $('#pay_now').val(),
                // staffId:$('#selectStaff').find(":selected").val(),
                due: parseInt($('#due2').html())
            }
// alert("OK");
            $.ajax({
                url: "/addCheckoutDetail",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    window.location.href = "{{ route('collectionManager') }}";

                }
            });
        }



        $(document).ready(function() {

            let order_detail_id = $('#order_details_id').val();

            $.ajax({
                url: "/getTotalPrice/" + order_detail_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response.data);
                    let totalPrice = 0;
                    response.data.forEach(function(row) {
                        totalPrice += row.orderRate;
                    });
                    console.log(totalPrice);
                    $('#total_price').html(totalPrice + ' Tk.');
                    $('#grand_total').html(totalPrice + ' Tk.');
                }
            });

            // $('.summernote').summernote();
            $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });



            $("#pay_now").keyup(function() {
                let gtotal = $('#grand_total').html();
                let prevDue = $('#prev_due').html();

                // alert(prevDue);
                let pnow = $('#pay_now').val();
                let grandTotal = parseInt(gtotal);
                let prev_due = parseInt(prevDue);
                let pdue = prev_due - pnow;

                let gdue = grandTotal - pnow;
                // alert(prevDue);
                if (grandTotal >= pnow) {
                    $("#due, #due2, #due3").html(gdue + ' Tk.');
                }

                if (prev_due >= pnow) {
                    $("#due, #due2, #due3").html(pdue + ' Tk.');
                }


            });



        });
    </script>
@endsection
