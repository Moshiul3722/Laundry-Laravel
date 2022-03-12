@extends('admin.app')

@section('title', 'Area')

@section('csslinks')

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Area</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <input type="hidden" id="area_id" name="area_id">
                <div class="col-sm-4">
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="areaName">Area Name</label>
                        <input type="text" id="areaName" placeholder="Enter Area Name" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="addArea" type="submit">Add
                        Area</button>
                    <button class="btn btn-sm btn-primary btn-outline m-t-n-xs btnUpdateHide" id="updateArea"
                        type="submit">Update Area</button>
                    <label> </label>
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
                            <table id="areaTable" class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>City Name</th>
                                        <th>Area Name</th>
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
                                        <th>Area Name</th>
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
    {{-- <script src="http://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script> --}}
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('#updateArea').hide();
            $(document).on('click', '#addArea', function(e) {
                e.preventDefault();
                var data = {
                    city_id: $('#selectCity').find(":selected").val(),
                    area_name: $('#areaName').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                if (!$('#areaName').val() || !$('#selectCity').val()) {
                    setTimeout(function() {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            showMethod: 'slideDown',
                            timeOut: 4000
                        };
                        toastr.warning('Please fill the input field',
                            'City/ Area can not be Empty!!');
                    }, 1300);
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/addArea",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.status == 400) {
                                setTimeout(function() {
                                    toastr.options = {
                                        closeButton: true,
                                        progressBar: true,
                                        positionClass: 'toast-top-right',
                                        showMethod: 'slideDown',
                                        timeOut: 4000
                                    };
                                    toastr.warning('Please insert another area',
                                        response
                                        .message);
                                }, 1300);
                            } else {
                                $('#selectCity').val(0);
                                $('#areaName').val('');
                                setTimeout(function() {
                                    toastr.options = {
                                        closeButton: true,
                                        progressBar: true,
                                        showMethod: 'slideDown',
                                        timeOut: 4000
                                    };
                                    toastr.success(response.message,
                                        'Area Added Successfully');
                                }, 1300);
                                areaTable.ajax.reload();
                                // fetchAreas();
                            }

                        }
                    });
                }


            });



            // Data Display into DataTable

            var areaTable = $('#areaTable').DataTable({
                pageLength: 10,
                paging: true,
                processing: true,
                info: true,
                ajax: "{{ url('getAreaList') }}",
                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center"
                    },
                    {
                        "data": "city_name"
                    },
                    {
                        "data": "area_name"
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
                            return `<button id="edit_area" data-id="${row.id}" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button data-id="${row.id}" class="btn btn-danger btn-sm btn-outline" id="btn-delete-area"><i class="fa fa-trash"></i></button>`;
                        },
                        "className": "text-center"
                    }
                ]
            });

            //active-inactive
            $(document).on('click', '#active', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('areaStatusInactive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        areaTable.ajax.reload();
                    }

                });
            });

            $(document).on('click', '#inactive', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('areaStatusActive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        areaTable.ajax.reload();
                    }

                });
            });

            // Edit Area from Database
            $(document).on('click', '#edit_area', function(e) {
                e.preventDefault();
                // $('#selectCity').editableSelect();
                $('#addArea').hide();
                $('#updateArea').show();
                var area_id = $(this).data('id');
                // console.log(area_id);

                $.ajax({
                    type: "GET",
                    url: "/edit-area/" + area_id,
                    success: function(response) {
                        if (response.status == 400) {
                            //some staff goes here
                        } else {
                            // console.log(response);
                            $('#area_id').val(area_id);
                            $('#areaName').val(response.area[0].area_name);
                            $("#selectCity option:selected").text(response.area[0].city_name);
                        }
                    }
                });
            });


            $(document).on('click', '#updateArea', function(e) {
                e.preventDefault();
                var area_id = $('#area_id').val();
                // alert(area_id);
                var data = {
                    _token: "{{ csrf_token() }}",
                    selectedCity: $('#selectCity').val(),
                    areaName: $('#areaName').val()
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
                            url: "/updateArea/" + area_id,
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                // console.log(response);
                                $('#selectCity').val('');
                                $('#selectCity').append(
                                    '<option value="0" selected disabled>--- Select City ---</option>'
                                );
                                $('#areaName').val('');
                                $('#addArea').show();
                                $('#updateArea').hide();

                                swal({
                                    title: "Hello",
                                    text: response.message,
                                    icon: "success",
                                    button: "Ok",
                                }).then((confirm) => {
                                    areaTable.ajax.reload();
                                });
                            }
                        });
                    } else {
                        swal("You have fired!!!");
                    }
                });
            });



            // Delete Area

            $(document).on('click', '#btn-delete-area', function(e) {
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
                            url: "{{ url('deleteAreaByID') }}",
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
                                    areaTable.ajax.reload();
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
