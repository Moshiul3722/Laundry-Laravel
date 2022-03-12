@extends('admin.app')

@section('title', 'Vendors')

@section('csslinks')

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Vendor Management</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row vendorReset">
                <input type="hidden" id="vendorId" name="vendorId">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="vendorName">Vendor Name</label>
                        <input type="text" id="vendorName" name="vendorName" value="" placeholder="Enter vendor name"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="venPhone">Vendor Phone</label>
                        <input type="text" id="venPhone" name="venPhone" value="" placeholder="Enter mobile no."
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="shopName">Shop Name</label>
                        <input type="text" id="shopName" name="shopName" value="" placeholder="Enter shop name"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="shopAddress">Shop Address</label>
                        <textarea name="shopAddress" id="shopAddress" class="form-control" rows="1"
                            placeholder="Enter shop address" required></textarea>
                    </div>
                </div>


                {{-- <div class="col-sm-4 vendorStatusHide" id="vendorStatus">
                    <div class="form-group">
                        <label class="col-form-label" for="shopAddress">Shop Address</label>


                        <select name="editStatus" class="form-control" id="selectVendor">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="selectCity">Select City</label>
                        <select name="selectCity" class="form-control" id="selectCity">
                            <option value="0" selected disabled>--- Select City ---</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group" style="position: relative">
                        <label class="col-form-label" for="selectArea">Area Name</label>
                        <select name="selectArea" class="form-control" id="selectArea">
                            <option value="0" selected disabled>--- Select Area ---</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                            @endforeach
                        </select>
                        <img id="loader" src="{{ asset('admin/img') }}/loader.gif" alt="Loading..." />
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="addVendor" type="submit">Add
                    Vendor</button>
                <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="updateVendor" type="submit">Update
                    Vendor</button>
                <label> </label>
            </div>
        </div>





        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="vendorTable"
                                class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Vendor Name</th>
                                        <th>Phone</th>
                                        <th>Area</th>
                                        <th>Shop Name</th>
                                        <th>Address</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Vendor Name</th>
                                        <th>Phone</th>
                                        <th>Area</th>
                                        <th>Shop Name</th>
                                        <th>Address</th>
                                        <th style="text-align: center">Status</th>
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
    <style>
        #loader {
            position: absolute;
            width: 24px;
            right: 20px;
            top: 41px;
        }

    </style>
@endsection

@section('scripts')
    <script src="{{ asset('admin/js') }}/plugins/dataTables/datatables.min.js"></script>
    <script src="{{ asset('admin/js') }}/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(function() {
            var loader = $('#loader'),
                city = $('select[name="selectCity"]'),
                area = $('select[name="selectArea"]');

            loader.hide();
            area.attr('disabled', 'disabled');

            area.change(function() {
                var id = $(this).val();
                if (id == 0) {
                    area.attr('disabled', 'disabled')
                }
            });

            city.change(function() {
                var id = $(this).val();
                if (id) {
                    loader.show();
                    area.attr('disabled', 'disabled');
                    $.get('{{ url('/getOrderArea?location_id=') }}' + id).then(successCallback,
                        errorCallback);

                    function successCallback(response) {
                        let area = '<option value="0">---Select Area---</option>';
                        response.forEach(function(row) {
                            area += '<option value="' + row.id + '">' + row.area_name + '</option>';
                        });
                        // area.removeAttr('disabled');
                        $('select[name="selectArea"]').removeAttr("disabled");
                        $('select[name="selectArea"]').html(area);
                        loader.hide();
                    }

                    function errorCallback(error) {
                        //error code
                    }
                }
            });

        });
        $(document).ready(function() {
            $('#updateVendor').hide();
            $(document).on('click', '#addVendor', function(e) {
                e.preventDefault();
                //  alert($('#selectCity').val());
                var data = {
                    // city_id: $('#selectCity').val(),
                    area_id: $('#selectArea').val(),
                    vendor_phone: $('#venPhone').val(),
                    vendor_name: $('#vendorName').val(),
                    shop_name: $('#shopName').val(),
                    shop_address: $('#shopAddress').val()
                }


                if ($('#selectCity').val() == null || data.area_id == 0 || data.vendor_phone == '' || data
                    .vendor_name == '' || data.shop_name == '' || data.shop_address == '') {
                    toastr.warning('Please insert data correctly!!');
                } else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/addVendor",
                        type: "POST",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            if (response.status == 400) {
                                toastr.warning('Please insert another!!', response.message);
                            } else {
                                $('#vendorName').val('');
                                $('#shopName').val('');
                                $('#shopAddress').val('');

                                toastr.success(response.message, 'Vendor Added Successfully');
                                table.ajax.reload();
                            }
                        }
                    }); //end ajax call
                } //end else
            });



            // Data Display into DataTable

            var table = $('#vendorTable').DataTable({
                pageLength: 10,
                paging: true,
                processing: true,
                info: true,
                ajax: "{{ url('getVendors') }}",
                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center"

                    },
                    {
                        "data": "ven_name"
                    }, {
                        "data": "ven_phone"
                    }, {
                        "data": "area_name"
                    },
                    {
                        "data": "shop_name"
                    },
                    {
                        "data": "shop_address"
                    },
                    {
                        "data": null,
                        render: function(data, type, row) {
                            if (row.status == 1) {
                                return `<button id="active" data-id="${row.id}"  class="btn btn-primary btn-sm btn-outline">Active</button>`;
                            } else {
                                return `<button id="inactive" data-id="${row.id}" class="btn btn-warning btn-sm btn-outline">Inactive</button>`;
                            }
                        },
                        "className": "text-center"
                    },
                    {
                        "data": null,
                        render: function(data, type, row) {
                            return `<button id="editVendor" data-id="${row.id}" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button data-id="${row.id}" class="btn btn-danger btn-sm btn-outline" id="deleteVendor"><i class="fa fa-trash"></i></button>`;
                        },
                        "className": "text-center"
                    }
                ]

            });


            //active-inactive
            $(document).on('click', '#active', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('vendorStatusInactive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        table.ajax.reload();
                    }

                });
            }); // end active function

            $(document).on('click', '#inactive', function() {
                $.ajax({
                    url: "{{ url('vendorStatusActive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        table.ajax.reload();
                    }

                });
            }); //end inactive function

            // Edit Vendor information
            $(document).on('click', '#editVendor', function() {
                $("#vendorStatus").removeClass("vendorStatusHide");
                $("#vendorStatus").addClass("vendorStatusShow");
                // $("#updateVendor").removeClass("btnUpdateHide");
                // $("#updateVendor").addClass("btnUpdateShow");
                $("#updateVendor").show();
                $("#addVendor").hide();
                $.ajax({
                    url: "{{ url('getVendorByID') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('input[name="vendorId"]').val(response.data.id);
                        $('input[name="vendorName"]').val(response.data.ven_name);
                        $('input[name="venPhone"]').val(response.data.ven_phone);
                        $('input[name="shopName"]').val(response.data.shop_name);
                        $('textarea[name="shopAddress"]').val(response.data.shop_address);
                        // $('select[name="editStatus"]').val(response.data.status);
                        $("#selectCity option:selected").text(response.data.city_name);
                        $("#selectArea option:selected").text(response.data.area_name);
                        // $('select[name="editStatus"]').find("option:contains(" + response.data
                        //     .status + ")").attr('selected', 'selected');


                        table.ajax.reload();


                    }
                });
            });


            // Update Vendor Information
            $(document).on('click', '#updateVendor', function(e) {
                e.preventDefault();
                var vendor_id = $('#vendorId').val();

                var data = {
                    _token: "{{ csrf_token() }}",
                    area_id: $('#selectArea').val(),
                    vendor_phone: $('#venPhone').val(),
                    vendor_name: $('#vendorName').val(),
                    shop_name: $('#shopName').val(),
                    shop_address: $('#shopAddress').val()
                }

                swal({
                    title: "Are you sure?",
                    text: "You want to edit this Item!!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "/updateVendor/" + vendor_id,
                            type: 'post',
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                table.ajax.reload();
                                $('#vendorName').val('');
                                $('#selectCity').append(
                                    '<option value="0" selected disabled>--- Select City ---</option>'
                                );
                                $('#selectArea').append(
                                    '<option value="0" selected disabled>--- Select Area ---</option>'
                                );
                                $('#venPhone').val('');
                                $('#shopName').val('');
                                $('#shopAddress').val('');
                                $("#vendorStatus").removeClass("vendorStatusShow");
                                $("#vendorStatus").addClass("vendorStatusHide");
                                $("#updateVendor").removeClass("btnUpdateShow");
                                $("#addVendor").show();
                                $("#updateVendor").hide();

                                swal({
                                    title: "Hello",
                                    text: response.message,
                                    icon: "success",
                                    button: "Ok",
                                }).then((confirm) => {
                                    table.ajax.reload();
                                });
                            }
                        });

                    } else {
                        swal("You have fired!!!");
                    }
                });
            });



            // Delete Vendor

            $(document).on('click', '#deleteVendor', function(e) {
                e.preventDefault();

                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Item!!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ url('deleteVendorByID') }}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": $(this).data('id')
                            },
                            success: function(response) {
                                swal({
                                    title: "Hello",
                                    text: "Item delete successfully",
                                    icon: "error",
                                    button: "Ok",
                                }).then((confirm) => {
                                    table.ajax.reload();
                                });
                            }
                        });
                    } else {
                        swal("You have fired!!!");
                    }
                });
            });


            //End of the document
        });
    </script>
@endsection
