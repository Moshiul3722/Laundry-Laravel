@extends('admin.app')

@section('title', 'Items')

@section('csslinks')

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Item Management</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <input type="hidden" id="itemId" name="itemId">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="vendorName">Category Name</label>
                        <select name="selectCategory" class="form-control" id="selectCategory">
                            <option value="0" selected disabled>--- Select Category ---</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="itemName">Item Name</label>
                        <input type="text" id="itemName" name="itemName" placeholder="Enter Item name"
                            class="form-control">
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="itemPrice">Price</label>
                        <input type="number" min="0" id="itemPrice" name="itemPrice" value="" placeholder="Enter item price"
                            class="form-control">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-sm btn-primary btn-outline m-t-n-xs" id="addItem" type="submit">Add
                        Item</button>
                    <button class="btn btn-sm btn-primary btn-outline m-t-n-xs btnUpdateHide" id="updateItem"
                        type="submit">Update
                        Item</button>

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
                            <table id="itemTable" class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Price</th>
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
            $(document).on('click', '#addItem', function(e) {
                e.preventDefault();
                // alert($('#itemPrice').val());
                var data = {
                    category_id: $('#selectCategory').find(":selected").val(),
                    item_name: $('#itemName').val(),
                    price: $('#itemPrice').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!$('#itemName').val()||!$('#itemPrice').val()||!$('#selectCategory').val()) {
                        toastr.warning('Please fill the input field', 'Category/ Item Name/ Price can not be Empty!!');
                } else {
                    $.ajax({
                        url: "/addItem",
                        type: "POST",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.status == 400) {
                                toastr.warning(
                                        'Please insert another Item name',
                                        response.message);
                            } else {
                                $('#itemName').val('');
                                $('#itemPrice').val('');
                                // $('#selectCategory').val('');
                                $('#selectCategory').append(
                                    '<option value="0" selected disabled>--- Select Category ---</option>'
                                    );

                                    toastr.success(response.message,
                                        'Item Added Successfully');
                           
                                table.ajax.reload();
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            // $('#nameError').text(response.responseJSON.errors.name);
                        }
                    });
                }
            });



            // Data Display into DataTable

            var table = $('#itemTable').DataTable({
                pageLength: 10,
                paging: true,
                processing: true,
                info: true,
                ajax: "{{ url('getItems') }}",
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
                        "data": "category_name"
                    },
                    {
                        "data": "price"
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
                            return `<button id="editItem" data-id="${row.id}" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button data-id="${row.id}" class="btn btn-danger btn-sm btn-outline" id="deleteItem"><i class="fa fa-trash"></i></button>`;
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

            // Edit Items information
            $(document).on('click', '#editItem', function() {

                $("#updateItem").removeClass("btnUpdateHide");
                $("#updateItem").addClass("btnUpdateShow");
                $("#addItem").hide();
                $.ajax({
                    url: "{{ url('getItemByID') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('input[name="itemId"]').val(response.data.id);
                        $('input[name="itemName"]').val(response.data.name);
                        $('input[name="itemPrice"]').val(response.data.price);
                        $("#selectCategory option:selected").text(response.data.category_name);
                        table.ajax.reload();


                    }
                });
            });


            // Update Items Information
            $(document).on('click', '#updateItem', function(e) {
                e.preventDefault();
                var item_id = $('#itemId').val();
                // alert($(item_id);
                // alert($('#selectCategory').find(":selected").val());
                // alert($('select#selectCategory').find('option:selected').val());

                var data = {
                    _token: "{{ csrf_token() }}",
                    item_name: $('#itemName').val(),
                    category_id: $('#selectCategory').val(),
                    price: $('#itemPrice').val()
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
                            url: "/updateItem/" + item_id,
                            type: 'post',
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                // table.ajax.reload();
                                $('#itemName').val('');
                                $('#itemPrice').val('');
                                // $('#selectCategory').val('');
                                $('#selectCategory').append(
                                    '<option value="0" selected disabled>--- Select Category ---</option>'
                                    );
                                $("#updateItem").removeClass("btnUpdateShow");
                                $("#updateItem").addClass("btnUpdateHide");
                                $("#addItem").show();

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



            // Delete Item

            $(document).on('click', '#deleteItem', function(e) {
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
                            url: "{{ url('deleteItemByID') }}",
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
