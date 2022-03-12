<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('user')) {
            // return view('backend.userdash');
            return view('admin.pages.dashboard');
        } elseif (Auth::user()->hasRole('admin')) {
            return view('backend.admindash');
        } elseif (Auth::user()->hasRole('superadmin')) {
            // return view('dashboard');
            // return view('backend.master')
            return view('admin.pages.dashboard');;
        }
    }

    public function profile()
    {
        return view('backend.myprofile');
    }

    public function dashboardNew()
    {
        return view('admin.pages.dashboard');
    }
}
