@extends('admin.app')

@section('title', 'Add City')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Locations</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <input type="hidden" id="city_id">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Add City</label>
                            <div class="col-lg-9">
                                <input type="text" id="cityName" placeholder="Enter City Name" class="form-control">
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-sm btn-primary btn-outline float-right m-t-n-xs" id="btn-add-city"
                                type="submit">
                                Add City
                            </button>
                            <button class="btn btn-sm btn-primary btn-outline float-right m-t-n-xs" id="btn-update-city"
                                type="submit">
                                Update City
                            </button>

                            <label> </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="cityTable" class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>City Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>City Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
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
    <script src="{{ asset('admin/js') }}/plugins/dataTables/datatables.min.js"></script>
    <script src="{{ asset('admin/js') }}/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('#btn-update-city').hide();
            $(document).on('click', '#btn-add-city', function(e) {
                e.preventDefault();
                var data = {
                    'cityName': $('#cityName').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/addCity",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            setTimeout(function() {
                                toastr.options = {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: 'toast-top-center',
                                    showMethod: 'slideDown',
                                    timeOut: 4000
                                };
                                toastr.warning('Please insert another city', response
                                    .message);

                            }, 1300);
                        } else {
                            $('#cityName').val('');
                            setTimeout(function() {
                                toastr.options = {
                                    closeButton: true,
                                    progressBar: true,
                                    showMethod: 'slideDown',
                                    timeOut: 4000
                                };
                                toastr.success(response.message,
                                    'City Added Successfully');

                            }, 1300);
                        }
                        cityTable.ajax.reload();
                    }
                });
            });

            // Display City into DataTable
            var cityTable = $('#cityTable').DataTable({
                pageLength: 10,
                paging: true,
                processing: true,
                info: true,
                ajax: "{{ url('fetchCities') }}",
                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center"
                    },
                    {
                        "data": "city_name"
                    }, {
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
                            return `<button id="edit_city" data-id="${row.id}" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button data-id="${row.id}" class="btn btn-danger btn-sm btn-outline" id="btn-delete-city"><i class="fa fa-trash"></i></button>`;
                        },
                        "className": "text-center"
                    }
                ]
            });

            //active-inactive
            $(document).on('click', '#active', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('locationStatusInactive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        cityTable.ajax.reload();
                    }

                });
            });

            $(document).on('click', '#inactive', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('locationStatusActive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        cityTable.ajax.reload();
                    }

                });
            });


            // Edit city from Database
            $(document).on('click', '#edit_city', function(e) {
                e.preventDefault();
                $('#btn-add-city').hide();
                $('#btn-update-city').show();
                var city_id = $(this).data('id');
                // alert(city_id);
                $.ajax({
                    type: "GET",
                    url: "/edit-city/" + city_id,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {

                        } else {
                            $('#cityName').val(response.city.city_name);
                            $('#city_id').val(city_id);
                        }
                    }
                });
            });



            $(document).on('click', '#btn-update-city', function(e) {
                e.preventDefault();

                var city_id = $('#city_id').val();

                var data = {
                    _token: "{{ csrf_token() }}",
                    city_name: $('#cityName').val()
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
                            type: "PUT",
                            url: "/updateCity/" + city_id,
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                $('#cityName').val('');
                                $('#btn-add-city').show();
                                $('#btn-update-city').hide();

                                swal({
                                    title: "Hello",
                                    text: response.message,
                                    icon: "success",
                                    button: "Ok",
                                }).then((confirm) => {
                                    cityTable.ajax.reload();
                                });
                            }
                        });
                    } else {
                        swal("You have fired!!!");
                    }
                });
            });

            // Delete City
            $(document).on('click', '#btn-delete-city', function(e) {
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
                            url: "{{ url('deleteCityByID') }}",
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
                                    cityTable.ajax.reload();
                                });
                            }
                        });
                    } else {
                        swal("You have fired!!!");
                    }
                });
            });
        });
    </script>
@endsection
