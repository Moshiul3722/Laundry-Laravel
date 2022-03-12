@extends('admin.app')

@section('title', 'Category')

@section('csslinks')

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Category Management</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox-content m-b-sm border-bottom">
            <span class="text-danger" id="nameError"></span>
            <div class="row">
                <input type="hidden" id="categoryId" name="categoryId">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="categoryName" placeholder="Enter Category name"
                            class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="addCategory" type="submit">Add
                        Category</button>
                    <button class="btn btn-sm btn-primary btn-outline m-t-n-xs btnUpdateHide" id="updateCategory"
                        type="submit">Update
                        Category</button>

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
                            <table id="categoryTable"
                                class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Category Name</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Category Name</th>
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

@endsection

@section('scripts')
    <script src="{{ asset('admin/js') }}/plugins/dataTables/datatables.min.js"></script>
    <script src="{{ asset('admin/js') }}/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            // $('#updateVendor').hide();
            $(document).on('click', '#addCategory', function(e) {
                e.preventDefault();
                // alert($('#categoryName').val());
                var data = {
                    category_name: $('#categoryName').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                if (!$('#categoryName').val()) {
                    setTimeout(function() {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            showMethod: 'slideDown',
                            timeOut: 4000
                        };
                        toastr.warning('Please fill the input field', 'Category Name is Empty!!');
                    }, 1300);
                } else {
                    $.ajax({
                        url: "/addCategory",
                        type: "POST",
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
                                    toastr.warning(
                                        'Please insert another Category name',
                                        response.message);
                                }, 1300);
                            } else {
                                // $('#selectCity').val(0);
                                // $('#areaName').val('');
                                $('#categoryName').val('');

                                setTimeout(function() {
                                    toastr.options = {
                                        closeButton: true,
                                        progressBar: true,
                                        positionClass: 'toast-top-right',
                                        showMethod: 'slideDown',
                                        timeOut: 4000
                                    };
                                    toastr.success(response.message,
                                        'Category Added Successfully');
                                }, 1300);
                                table.ajax.reload();
                            }

                        },
                        error: function(response) {
                            console.log(response);
                            $('#nameError').text(response.responseJSON.errors.name);
                        }
                    });
                }
            });



            // Data Display into DataTable

            var table = $('#categoryTable').DataTable({
                pageLength: 10,
                paging: true,
                processing: true,
                info: true,
                ajax: "{{ url('getCategories') }}",
                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center"

                    },
                    {
                        "data": "name"
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
                            return `<button id="editCategory" data-id="${row.id}" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button data-id="${row.id}" class="btn btn-danger btn-sm btn-outline" id="deleteCategory"><i class="fa fa-trash"></i></button>`;
                        },
                        "className": "text-center"
                    }
                ]

            });


            //active-inactive
            $(document).on('click', '#active', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('editStatusToInactive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        table.ajax.reload();
                    }

                });
            });

            $(document).on('click', '#inactive', function() {
                // alert('active-' + $(this).data('id'));
                $.ajax({
                    url: "{{ url('editStatusToActive') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        table.ajax.reload();
                    }

                });
            });

            // Edit Category information
            $(document).on('click', '#editCategory', function() {

                $("#updateCategory").removeClass("btnUpdateHide");
                $("#updateCategory").addClass("btnUpdateShow");
                $("#addCategory").hide();
                $.ajax({
                    url: "{{ url('getCategoryByID') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        // console.log(response.data);
                        $('input[name="categoryId"]').val(response.data.id);
                        $('input[name="categoryName"]').val(response.data.name);
                        table.ajax.reload();


                    }
                });
            });


            // Update Vendor Information

            $(document).on('click', '#updateCategory', function(e) {
                e.preventDefault();
                var category_id = $('#categoryId').val();
                // alert($('#categoryName').val());
                var data = {
                    _token: "{{ csrf_token() }}",
                    category_name: $('#categoryName').val()
                }


                swal({
                    title: "Are you sure?",
                    text: "You want to edit this Category!!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "/updateCategory/" + category_id,
                            type: 'post',
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                // table.ajax.reload();
                                $('#categoryName').val('');
                                $("#updateCategory").removeClass("btnUpdateShow");
                                $("#updateCategory").addClass("btnUpdateHide");
                                $("#addCategory").show();

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

            $(document).on('click', '#deleteCategory', function(e) {
                e.preventDefault();

                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Category!!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('deleteCategoryByID') }}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": $(this).data('id')
                            },
                            success: function(response) {
                                swal({
                                    title: "Hello",
                                    text: "Category delete successfully",
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
