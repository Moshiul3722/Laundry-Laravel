<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = DB::table('order_details')->select('order_details.id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'order_details.required_services', 'locations.city_name', 'areas.area_name', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message')
            ->leftJoin('users', 'users.id', '=', 'order_details.user_id')
            ->leftJoin('areas', 'areas.id', '=', 'order_details.area_id')
            ->leftJoin('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.picked_up', 0)
            ->orderBy('order_details.id', 'desc')
            ->get();

        return view('admin.pages.phone_order', compact('orderDetails'));
    }

    public function manage_order()
    {
        //get all cities
        $cities = DB::table('locations')->get();

        //get phone no.
        $phoneNos = DB::table('users')
            ->select('id', 'fname', 'lname', 'email', 'phone')
            ->orderBy('phone', 'desc')
            ->get();
        return view('admin.pages.manage_phoneOrder', compact('cities', 'phoneNos'));
    }


    public function phone_order_process()
    {
        // return $request->post();
        return view('admin.pages.manage_phoneOrder');
    }


    public function manage_order_process(Request $request, $id = '')
    {

        return $request->post();
    }

    public function store_phone_order(Request $request)
    {
        $serviceTypeArrayToString = implode(',', $request->serviceType);
        $userInfo = DB::table('users')->where('id', $request->userId)->get();

        if ($userInfo->count()) {
            $orderDetail = new OrderDetail();
            $orderDetail->user_id = $request->input('userId');
            $orderDetail->area_id = $request->input('area_id');
            $orderDetail->required_services = $serviceTypeArrayToString;
            $orderDetail->pick_up_date = $request->input('date');
            $orderDetail->pick_up_time = $request->input('time');
            $orderDetail->pay_type = $request->input('payType');
            $orderDetail->message = $request->input('textarea');
            // $orderDetail->picked_up = '0';
            $orderDetail->save();
            return response()->json([
                'status' => 200,
                'message' => $userInfo,
            ]);
        } else {
            $users = new User();
            $users->fname = $request->input('customerName');
            $users->lname = '';
            $users->email = $request->input('email');
            $users->phone = $request->input('phone');
            $users->password = $request->input('customerName');
            $users->save();

            $findUserIdByPhone = DB::table('users')
                ->select('id')
                ->where('phone', $request->input('phone'))->first();
            $orderDetail = new OrderDetail();
            $orderDetail->user_id = $findUserIdByPhone->id;
            $orderDetail->area_id = $request->input('area_id');
            $orderDetail->required_services = $serviceTypeArrayToString;
            $orderDetail->pick_up_date = $request->input('date');
            $orderDetail->pick_up_time = $request->input('time');
            $orderDetail->pay_type = $request->input('payType');
            $orderDetail->message = $request->input('textarea');
            // $orderDetail->picked_up = '0';
            $orderDetail->save();

            if ($orderDetail) {
                return response()->json([
                    'status' => 200,
                    'orderDetail' => 'Order Saved Successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'User Information Not Found.',
                ]);
            }
        }
    }

    public function getOrderArea(Request $request)
    {
        if ($request->has('location_id')) {
            return DB::table('areas')->where('city_id', $request->input('location_id'))->get();
        }
    }


    public function getPhones(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $users = User::orderby('id', 'desc')
                ->select('id', 'phone')
                ->limit(5)
                ->get();
        } else {
            $users = User::orderby('fname', 'asc')
                ->select('id', 'phone')
                ->where('phone', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                'id' => $user->id,
                'text' => $user->phone
            );
        }
        return response()->json($response);
    }

    public function getCustomerInfo($id)
    {
        // $userInfo = DB::table('users')->where('id', $id)->get();

        $userInfo = DB::table('order_details')
            ->select('order_details.id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.city_name', 'areas.area_name', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.user_id', $id)
            // ->orderBy('order_details.id', 'desc')
            ->first();

        if ($userInfo) {
            return response()->json([
                'status' => 200,
                'userInfo' => $userInfo,
            ]);
        } else {
            $user = DB::table('users')
                ->select('id', 'fname', 'lname', 'email', 'phone')
                ->orderBy('phone', 'desc')
                ->where('id', $id)
                ->first();
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'userInfo' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'User Information Not Found.',
                ]);
            }
            return response()->json([
                'status' => 400,
                'message' => 'User Information Not Found.',
            ]);
        }
    }

    public function getOrder($id)
    {
        $orderDetail = DB::table('order_details')
            ->where('order_details.id', $id)
            ->select('order_details.id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.city_name', 'areas.area_name', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->get();

        if ($orderDetail) {
            return response()->json([
                'status' => 200,
                'message' => 'Order Saved Successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'User Information Not Found.',
            ]);
        }
    }
}
