@extends('admin.app')

@section('title', 'Staff')

@section('csslinks')

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Staff Management</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row vendorReset">
                <input type="hidden" id="staffId" name="staffId">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="staffName">Name</label>
                        <input type="text" id="staffName" name="staffName" value="" placeholder="Enter Staff name"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="staffPhone">Phone</label>
                        <input type="text" id="staffPhone" name="staffPhone" value="" placeholder="Enter mobile no."
                            class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="staffDesig">Designation</label>
                    <input type="text" id="staffDesig" name="staffDesig" value="" placeholder="Enter Staff name"
                        class="form-control">
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="staffAddress">Address</label>
                        <textarea name="staffAddress" id="staffAddress" class="form-control" rows="1"
                            placeholder="Enter address" required></textarea>
                    </div>
                </div>



            </div>

            <div>
                <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="addStaff" type="submit">Add
                    Staff</button>
                <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="updateStaff" type="submit">Update
                    Staff</button>
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
                            <table id="staffTable"
                                class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Staff Name</th>
                                        <th>Phone</th>
                                        <th>Designation</th>
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
                                        <th>Staff Name</th>
                                        <th>Phone</th>
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
        $(document).ready(function() {
            $('#updateStaff').hide();
            $(document).on('click', '#addStaff', function(e) {
                e.preventDefault();

                var data = {
                    staff_name: $('#staffName').val(),
                    staff_phone: $('#staffPhone').val(),
                    staff_desig: $('#staffDesig').val(),
                    staff_address: $('#staffAddress').val()
                }

                if (data.staff_name == '' || data.staff_phone == '' || data.staff_desig == '' || data
                    .staff_address == '') {
                    toastr.warning('Please insert data correctly!!');
                } else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/addStaff",
                        type: "POST",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            if (response.status == 400) {
                                toastr.warning('Please insert another!!', response.message);
                            } else {
                                $('#staffName').val('');
                                $('#staffPhone').val('');
                                $('#staffDesig').val('');
                                $('#staffAddress').val('');

                                toastr.success(response.message, 'Staff Added Successfully');
                                table.ajax.reload();
                            }
                        }
                    }); //end ajax call

                } //end else

            });



            // Data Display into DataTable

            var table = $('#staffTable').DataTable({
                pageLength: 10,
                paging: true,
                processing: true,
                info: true,
                ajax: "{{ url('getStaffs') }}",
                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center"

                    },
                    {
                        "data": "staff_name"
                    }, {
                        "data": "staff_phone"
                    }, {
                        "data": "staff_role"
                    },
                    {
                        "data": "address"
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
                            return `<button id="editStaff" data-id="${row.id}" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button data-id="${row.id}" class="btn btn-danger btn-sm btn-outline" id="deleteStaff"><i class="fa fa-trash"></i></button>`;
                        },
                        "className": "text-center"
                    }
                ]
            });


            //active-inactive
            $(document).on('click', '#active', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('staffStatusInactive') }}",
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
                    url: "{{ url('staffStatusActive') }}",
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


            // Edit Staff information
            $(document).on('click', '#editStaff', function() {
                $("#updateStaff").show();
                $("#addStaff").hide();
                $.ajax({
                    url: "{{ url('getStaffByID') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('input[name="staffId"]').val(response.data.id);
                        $('input[name="staffName"]').val(response.data.staff_name);
                        $('input[name="staffPhone"]').val(response.data.staff_phone);
                        $('input[name="staffDesig"]').val(response.data.staff_role);
                        $('textarea[name="staffAddress"]').val(response.data.address);
                        table.ajax.reload();
                    }
                });
            });


            // Update Staff Information
            $(document).on('click', '#updateStaff', function(e) {
                e.preventDefault();
                var staff_id = $('#staffId').val();

                var data = {
                    _token: "{{ csrf_token() }}",
                    staff_name: $('#staffName').val(),
                    staff_phone: $('#staffPhone').val(),
                    staff_desig: $('#staffDesig').val(),
                    staff_address: $('#staffAddress').val()
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
                            url: "/updateStaff/" + staff_id,
                            type: 'post',
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                table.ajax.reload();
                                $('#staffName').val('');
                                $('#staffPhone').val('');
                                $('#staffDesig').val('');
                                $('#staffAddress').val('');
                                $("#addStaff").show();
                                $("#updateStaff").hide();

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


            // Delete Staff

            $(document).on('click', '#deleteStaff', function(e) {
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
                            url: "{{ url('deleteStaffByID') }}",
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
