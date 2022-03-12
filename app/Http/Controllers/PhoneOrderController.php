<?php

namespace App\Http\Controllers;

use App\Models\PhoneOrder;
use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class PhoneOrderController extends Controller
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

    public function manage_phoneOrder(Request $request, $id = '')
    {

        //get all cities
        $cities = DB::table('locations')->get();

        $areas = DB::table('areas')->get();

        $phoneNos = DB::table('users')
            ->select('id', 'fname', 'lname', 'email', 'phone')
            ->orderBy('phone', 'desc')
            ->get();

        if ($id > 0) {
            //this is edited mood
            // echo 'Order Detail Id: ' . $id;
            $user_id = DB::table('order_details')->select('user_id')->where(['order_details.id' => $id])->first()->user_id;
            // echo '<pre>';
            // print_r($user_id);
            // die();
            // echo '<br>User id: ' . $user_id;


            $arr = DB::table('order_details')
                ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.postCode', 'order_details.customerAddress')
                ->join('users', 'users.id', '=', 'order_details.user_id')
                ->join('areas', 'areas.id', '=', 'order_details.area_id')
                ->join('locations', 'locations.id', '=', 'areas.city_id')
                ->where(['order_details.id' => $id])
                ->where(['order_details.user_id' => $user_id])
                // ->orderBy('order_details.id', 'desc')
                ->get();

            // echo '<pre>';
            // dd($arr);
            // die();

            // echo '<pre>';
            // print_r($arr);
            // die();
            $result['id'] = $arr['0']->id;
            $result['phone'] = $arr['0']->phone;
            $result['user_id'] = $arr['0']->user_id;
            $result['area_id'] = $arr['0']->area_id;
            $result['fname'] = $arr['0']->fname;
            $result['email'] = $arr['0']->email;
            $result['city_id'] = $arr['0']->city_id;
            $result['city_name'] = $arr['0']->city_name;
            $result['area_name'] = $arr['0']->area_name;
            $result['pick_up_date'] = $arr['0']->pick_up_date;
            $result['pick_up_time'] = $arr['0']->pick_up_time;
            $result['required_services'] = $arr['0']->required_services;
            $result['pay_type'] = $arr['0']->pay_type;
            $result['postCode'] = $arr['0']->postCode;
            $result['customerAddress'] = $arr['0']->customerAddress;
            $result['message'] = $arr['0']->message;
            $result['picked_up'] = $arr['0']->picked_up;
        } else {
            $result['id'] = 0;
            $result['phone'] = '';
            $result['user_id'] = '';
            $result['area_id'] = '';
            $result['fname'] = '';
            $result['email'] = '';
            $result['city_id'] = '';
            $result['city_name'] = '';
            $result['area_name'] = '';
            $result['pick_up_date'] = '';
            $result['pick_up_time'] = '';
            $result['required_services'] = '';
            $result['pay_type'] = '';
            $result['postCode'] = '';
            $result['customerAddress'] = '';
            $result['message'] = '';
            $result['picked_up'] = '';
        }

        return view('admin.pages.manage_phoneOrder', compact('phoneNos', 'cities', 'areas', 'result'));
    }

    public function manage_phoneOrder_process(Request $request)
    {

        // echo '<pre>';
        // dd($request->all());
        // die();

        $checkUser = DB::table('users')->where('phone', $request->post('phoneNo'))->first();

        if (isset($checkUser)) {
            // if user exist then order_details table will be populated by data

            if ($request->post('id') > 0) {
                $orderDetail = OrderDetail::find($request->post('id'));
                $message = "Order Updated";
            } else {
                $orderDetail = new OrderDetail();
                $message = "Order Inserted";
            }
            $orderDetail->user_id = $checkUser->id;
            $orderDetail->orderNo =
                Helper::OrderNumberGenerator(new OrderDetail, 'orderNo', 5, 'D');
            $orderDetail->city_id = $request->post('location_id');
            $orderDetail->area_id = $request->post('area_id');
            $orderDetail->required_services = implode(",", $request->post('services'));
            $orderDetail->pick_up_date = $request->post('pickUpDate');
            $orderDetail->pick_up_time = $request->post('timepkr');
            $orderDetail->pay_type = $request->post('cashRadio');
            $orderDetail->postCode = $request->post('postCode');
            $orderDetail->customerAddress = $request->post('customerAddress');
            $orderDetail->message = $request->post('message');
            $orderDetail->status = 1;
            $orderDetail->picked_up = 0;
            $orderDetail->payment_type = 0;
            $orderDetail->staff_id = 0;
            $orderDetail->save();
            $request->session()->flash('message', $message);
            return redirect('phone_order');
            // echo 'This user Already exist.';
        } else {
            // if user not exist then data will insert into users and order_details both table
            $users = new User();
            $users->fname = $request->post('customerName');
            $users->lname = '';
            $users->email = $request->post('email');
            $users->phone = $request->post('phoneNo');
            $users->password = Hash::make(Helper::generateRandomString(8));

            $users->save();

            $findUserIdByPhone = DB::table('users')
                ->select('id')
                ->where('phone', $request->post('phoneNo'))->first();

            $users->attachRole('user');

            $orderDetail = new OrderDetail();
            $orderDetail->user_id = $findUserIdByPhone->id;
            $orderDetail->orderNo =
                Helper::OrderNumberGenerator(new OrderDetail, 'orderNo', 5, 'D');
            $orderDetail->city_id = $request->post('location_id');
            $orderDetail->area_id = $request->post('area_id');
            $orderDetail->required_services = implode(",", $request->post('services'));
            $orderDetail->pick_up_date = $request->post('pickUpDate');
            $orderDetail->pick_up_time = $request->post('timepkr');
            $orderDetail->pay_type = $request->post('cashRadio');
            $orderDetail->message = $request->post('message');
            $orderDetail->postCode = $request->post('postCode');
            $orderDetail->customerAddress = $request->post('customerAddress');
            $orderDetail->status = 1;
            $orderDetail->picked_up = 0;
            $orderDetail->payment_type = 0;
            $orderDetail->save();
            $request->session()->flash('message', 'Order received successfully.');
            return redirect('phone_order');
        }
    }

    public function editPickedUpStatus(Request $request)
    {
        $result = OrderDetail::where('id', $request->id)->update(array('picked_up' => '1'));
        // return redirect('orderManagerList');
        // return redirect()->action([OrderManagerController::class, 'index']);
        // return redirect()->action('App\Http\Controllers\OrderManagerController@index');
        // return view('admin.pages.orderManager');
        return response()->json([
            'status' => 200,
            'result' => $result,
        ]);
    }

    public function delete_phoneOrder(Request $request, $id)
    {
        $orderId = OrderDetail::find($id);
        $orderId->delete();
        $request->session()->flash('message', 'Order deleted.');
        return redirect('phone_order');
    }




    public function getCustomerInfo($id)
    {
        // $userInfo = DB::table('users')->where('id', $id)->get();

        $userInfo = DB::table('order_details')
            ->select('order_details.id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.city_name', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message')
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


    public function getOrderArea(Request $request)
    {
        if ($request->has('location_id')) {
            return DB::table('areas')->where('city_id', $request->input('location_id'))->get();
        }
    }
}
