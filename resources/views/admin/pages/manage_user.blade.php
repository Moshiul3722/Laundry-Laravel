@extends('admin.app')

@section('title', 'User Profile')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Profile</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-7">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Profile <small></small></h5>
                        <div class="ibox-tools">
                            {{-- <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a> --}}
                            {{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a> --}}
                            {{-- <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul> --}}
                            {{-- <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> --}}
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 b-r">

                                <form role="form">
                                    <div class="form-group"><label>First Name</label>
                                        <input type="text" placeholder="Enter email" class="form-control"
                                            value="{{ $userInfo[0]->fname }}">
                                    </div>
                                    <div class="form-group"><label>Last Name</label>

                                        @if (empty($userInfo[0]->lname))
                                            <input type="text" placeholder="Enter email" class="form-control" value="">
                                        @else
                                            <input type="text" placeholder="Enter email" class="form-control"
                                                value="{{ $userInfo[0]->lname }}">
                                        @endif



                                    </div>
                                    <div class="form-group"><label>Email</label>
                                        <input type="email" placeholder="Enter email" class="form-control"
                                            value="{{ $userInfo[0]->email }}">
                                    </div>
                                    <div class="form-group"><label>Phone</label>
                                        <input type="text" placeholder="Enter email" class="form-control"
                                            value="{{ $userInfo[0]->phone }}">
                                    </div>
                                    <div class="form-group"><label>Password</label>
                                        <input type="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="form-group"><label>Confirm Password</label>
                                        <input type="password" placeholder="Confirm Password" class="form-control">
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs"
                                            type="submit">Edit Information</button>

                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6 b-r">

                                <div class="widget-head-color-box navy-bg p-lg text-center">
                                    {{-- <div class="m-b-md">
                                        <h2 class="font-bold no-margins">
                                            Alex Smith2
                                        </h2>
                                        <small>Founder of Groupeq</small>
                                    </div> --}}
                                    <img src="{{ asset('admin/img') }}/a4.jpg" class="rounded-circle circle-border m-b-md"
                                        alt="profile">
                                    {{-- <div>
                                        <span>100 Tweets</span> |
                                        <span>350 Following</span> |
                                        <span>610 Followers</span>
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection
