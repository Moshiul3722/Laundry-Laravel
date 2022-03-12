<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {

        $result['data'] = DB::table('role_user')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'roles.display_name as roles')
            // ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'order_details.orderNo','checkout_infos.grandTotal','checkout_infos.paid','checkout_infos.due','checkout_infos.created_at')
            // ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->get();

        // echo '<pre>';
        // print_r($result['data']);
        // echo '</pre>';
        return view('admin.pages.userManager', $result);
    }

    public function userProcess($id)
    {
        $userInfo = DB::table('role_user')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'roles.display_name as roles')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->where(['users.id' => $id])
            ->get();

        // echo '<pre>';
        // print_r($userInfo);
        // echo '</pre>';
        return view('admin.pages.manage_user',compact('userInfo'));
    }
}
