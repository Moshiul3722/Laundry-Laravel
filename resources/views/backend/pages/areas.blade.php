@extends('backend.master')

@section('css')
<link href="{{asset('backend/css')}}/notification.css" rel="stylesheet">
@endsection
@section('title','Employee')

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
                    <!-- <input type="hidden" id="city_id"> -->

                    <!-- <form action="submit-area" method="POST"> -->
                    <!-- {{csrf_field()}} -->
                    <div class="form-row align-items-center">
                        <div class="col-sm-2 my-1">
                            <label for="cityname" class=""><strong>City Name</strong></label>
                        </div>

                        <div class="col-sm-6 my-1">
                            <select class="form-control" id="selectCity">
                                <option selected>--- Select City ---</option>
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div><br />
                        <div class="col my-1">
                            <label for="areaname" class=""><strong>Area Name</strong></label>
                        </div>
                        <div class="col my-1">
                            <input type="text" id="areaName" class="form-control" placeholder="Enter Area Name">
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-outline-primary" id="addArea">Add Area</button>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '#addArea', function(e) {
            e.preventDefault();
            // var city_id = $('#selectCity').find(":selected").val();
            // alert(city_id);

            // var area_name = $('#areaName').val();
            // alert(area_name);

            var data = {
                city_id = $('#selectCity').find(":selected").val(),
                area_name = $('#areaName').val()
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/addArea",
                data: data,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                }
            });


        });

    });
</script>
@endsection