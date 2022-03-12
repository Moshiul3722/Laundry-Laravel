@extends('backend.master')

@section('css')
    <link href="{{ asset('backend/css') }}/notification.css" rel="stylesheet">
@endsection
@section('title', 'Employee')

@section('content')

    <div class="app-main__inner">
        <div id="alertBox" class="hide">
            <span class="fas"></span>
            <span class="msg"></span>
            <div class="close-btn">
                <span class="fas fa-times"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <input type="hidden" id="city_id">
                        <div class="form-row align-items-center">
                            <div class="col-sm-2 my-1">
                                <label for="cityname"
                                    class="">City Name</label>
                        </div>

                        <div class="
                                    col-sm-6 my-1">
                                    <input type="text" name="cityName" id="cityName" class="form-control"
                                        placeholder="Enter City Name">
                            </div>

                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-outline-primary" id="addCity">Add City</button>
                                <button type="submit" class="btn btn-outline-primary" id="update-city">Update City</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col mx-auto">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table id="cityTable" class="table table-striped table-sm text-center">
                            <thead class="align-middle">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- City Delete Modal -->

    <div class="modal fade" id="deleteCityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit & Update Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="deleteEmpId">
                    <h5>Are you sure? Want to delete this data?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_employee_data">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Employee Modal -->


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // $('#update-city').hide();
            // Add City to the database
            $(document).on('click', '#addCity', function(e) {
                e.preventDefault();
                // alert($('#cityName').val());
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
                        // console.log(response);
                        if (response.status == 400) {
                            $("#alertBox").addClass('show');
                            $("#alertBox").removeClass('hide');
                            $("#alertBox").addClass('showAlert');
                            $("#alertBox").removeClass('success');
                            $("#alertBox").addClass('warning');
                            $("#alertBox>.fas").addClass('fa-exclamation-circle');
                            $("#alertBox>.msg").text(response.message);
                            setTimeout(function() {
                                $('#alertBox').removeClass("show");
                                $('#alertBox').addClass('hide');
                            }, 5000);
                        } else {
                            $('#cityName').val('');
                            $('#alertBox').val('');
                            $("#alertBox").addClass('show');
                            $("#alertBox").removeClass('hide');
                            $("#alertBox").addClass('showAlert');
                            $("#alertBox").removeClass('warning');
                            $("#alertBox").addClass('success');
                            $("#alertBox>.fas").addClass('fa-check-circle');
                            $("#alertBox>.msg").text(response.message);
                            setTimeout(function() {
                                $('#alertBox').removeClass("show");
                                $('#alertBox').addClass('hide');
                            }, 5000);
                            fetchcities();
                        }
                    }
                });
            });

            // Fetch record from database

            fetchcities();

            function fetchcities() {
                let i = 0;
                $.ajax({
                    type: "GET",
                    url: "/fetchCities",
                    dataType: "json",
                    success: function(response) {
                        //console.log(response);
                        $('#cityTable tbody').html('');
                        $.each(response.cities, function(key, item) {
                            i++;
                            $('#cityTable tbody').append(
                                '<tr>\
                                <td scope="row">' + i + '</td>\
                                <td>' + item.city_name + '</td>\
                                <td>\
                                    <button type="button" value="' + item.id + '" id="edit_city" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i></button>\
                                    <button type="button" value="' + item.id + '" class="delete_city btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>\
                                </td>\
                            </tr>');
                        });
                    }
                });
            }

            // Edit city data

            $(document).on('click', '#edit_city', function(e) {
                e.preventDefault();
                $('#addCity').hide();
                $('#update-city').show();
                var city_id = $(this).val();
                // console.log(city_id);
                $.ajax({
                    type: "GET",
                    url: "/edit-city/" + city_id,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $("#alertBox").addClass('show');
                            $("#alertBox").removeClass('hide');
                            $("#alertBox").addClass('showAlert');
                            $("#alertBox").removeClass('success');
                            $("#alertBox").addClass('warning');
                            $("#alertBox>.fas").addClass('fa-exclamation-circle');
                            $("#alertBox>.msg").text(response.message);
                            setTimeout(function() {
                                $('#alertBox').removeClass("show");
                                $('#alertBox').addClass('hide');
                            }, 5000);
                        } else {
                            $('#cityName').val(response.city.city_name);
                            $('#city_id').val(city_id);
                        }
                    }
                });
            });

            $(document).on('click', '#update-city', function(e) {
                e.preventDefault();
                var city_id = $('#city_id').val();
                // alert($('#cityName').val());
                var data = {
                    'city_name': $('#cityName').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: "/updateCity/" + city_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $("#alertBox").addClass('show');
                            $("#alertBox").removeClass('hide');
                            $("#alertBox").addClass('showAlert');
                            $("#alertBox").removeClass('success');
                            $("#alertBox").addClass('warning');
                            $("#alertBox>.fas").addClass('fa-exclamation-circle');
                            $("#alertBox>.msg").text(response.message);
                            setTimeout(function() {
                                $('#alertBox').removeClass("show");
                                $('#alertBox').addClass('hide');
                            }, 5000);
                        } else {
                            $('#cityName').val('');
                            $('#alertBox').val('');
                            $("#alertBox").addClass('show');
                            $("#alertBox").removeClass('hide');
                            $("#alertBox").addClass('showAlert');
                            $("#alertBox").removeClass('warning');
                            $("#alertBox").addClass('success');
                            $("#alertBox>.fas").addClass('fa-check-circle');
                            $("#alertBox>.msg").text(response.message);
                            setTimeout(function() {
                                $('#alertBox').removeClass("show");
                                $('#alertBox').addClass('hide');
                            }, 5000);
                            $('#addCity').show();
                            $('#update-city').hide();
                            fetchcities();
                        }
                    }
                });
            });


            // Delete City from Database
            $(document).on('click', '.delete_city', function(e) {
                e.preventDefault();
                var city_id = $(this).val();
                // alert(city_id);
                $("#delete-city").val(city_id);
                $("#deleteCityModal").modal('show')
            });

        });
    </script>
@endsection
