<?php

namespace App\Http\Controllers;

use App\Models\CheckoutInfo;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $userInfo = DB::table('order_details')
            ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.payment_type', 'order_details.created_at', 'order_details.customerAddress', 'order_details.postCode')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.picked_up', 1)
            ->orderBy('order_details.id', 'desc')
            ->get();
        // echo '<pre>';
        // dd(print_r($userInfo));

        return view('admin.pages.orderManager', compact('userInfo'));
    }

    public function orderDetailByID($id)
    {
        $orderDetail = DB::table('order_details')
            ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.created_at')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.id', $id)
            // ->orderBy('order_details.id', 'desc')
            ->get();

        $phoneNos = DB::table('users')
            ->select('id', 'phone')
            ->orderBy('phone', 'desc')
            ->get();
        $cities = DB::table('locations')->get();

        $areas = DB::table('areas')->get();

        $service_category = DB::table('categories')->where(['status' => 1])->get();

        $service_items = DB::table('items')->where(['status' => 1])->get();

        $vendors = DB::table('vendors')->where(['status' => 1])->get();

        // echo '<pre>';
        // print_r($orderDetail[0]->fname);
        // die();

        return view('admin.pages.manage_orderManagerAddItems', compact('orderDetail', 'phoneNos', 'cities', 'areas', 'service_category', 'service_items', 'vendors'));
    }

    public function getServiceItem($id)
    {
        return DB::table('items')->where('category_id', $id)->get();
    }
    public function getVendorByID($id)
    {
        return DB::table('vendors')->where('area_id', $id)->get();
    }
    public function getItemPriceByID($id)
    {
        return DB::table('items')->where('id', $id)->get();
    }



    public function addItemOrder(Request $request)
    {
        // echo '<pre>';
        // dd(print_r($request->all()));

        $serviceCategoryArray = $request->post('serviceCategory');
        $serviceItemArray = $request->post('serviceItem');
        $orderQtyArray = $request->post('product_qty');
        $vendorAreaArray = $request->post('vendorArea');
        $vendorNameArray = $request->post('vendorName');
        // $itemProcessArray = $request->post('vendorName');
        foreach ($serviceCategoryArray as $key => $val) {

            $orderItems['order_detail_id'] = $request->post('itemId');
            $orderItems['item_process'] = 0;

            if ($serviceCategoryArray[$key] == '') {
                $orderItems['category_id'] = 0;
            } else {
                $orderItems['category_id'] = $serviceCategoryArray[$key];
            }

            if ($serviceItemArray[$key] == '') {
                $orderItems['item_id'] = 0;
            } else {
                $orderItems['item_id'] = $serviceItemArray[$key];
            }

            if ($orderQtyArray[$key] == '') {
                $orderItems['qty'] = 0;
            } else {
                $orderItems['qty'] = $orderQtyArray[$key];
            }

            if ($vendorAreaArray[$key] == '') {
                $orderItems['area_id'] = 0;
            } else {
                $orderItems['area_id'] = $vendorAreaArray[$key];
            }

            if ($vendorNameArray[$key] == '') {
                $orderItems['vendor_id'] = 0;
            } else {
                $orderItems['vendor_id'] = $vendorNameArray[$key];
            }

            DB::table('order_items')->insert($orderItems);
        }

        DB::table('order_details')
            ->where('id', $request->post('itemId'))
            ->update(array(
                'delivery_date' => $request->post('deliveryDate'),
                'delivery_time' =>  $request->post('timepkr2'),
                'staff_id' =>  $request->post('selectStaff'),
                'payment_type' => '1'
            ));

    //    return $this->checkoutManager($request->post('user_id'));
        return redirect('orderManagerList');
    }

    public function editItemOrder(Request $request, $id)
    {
        echo '<pre>';
        print_r($request->all());
    }

    public function manage_orderManager(Request $request, $id = '')
    {
        $cities = DB::table('locations')->get();

        $areas = DB::table('areas')->get();

        $phoneNos = DB::table('users')
            ->select('id', 'fname', 'lname', 'email', 'phone')
            ->orderBy('phone', 'desc')
            ->get();

        $items = DB::table('items')->where(['status' => 1])->get();

        $vendors = DB::table('vendors')->where(['status' => 1])->get();

        $service_category = DB::table('categories')->where(['status' => 1])->get();

        $service_items = DB::table('items')->where(['status' => 1])->get();

        $staffInfo = DB::table('staff')->where(['status' => 1])->get();

        $orderItems = DB::table('order_items')
            ->select('order_items.id as order_id', 'items.id as item_id', 'categories.id as categories_id', 'categories.name as category_name', 'items.name as item_name', 'items.price', 'order_items.qty', 'areas.id as area_id', 'areas.area_name', 'vendors.id as vendors_id', 'vendors.ven_name', 'vendors.ven_phone')
            ->join('order_details', 'order_details.id', '=', 'order_items.order_detail_id')
            ->join('categories', 'categories.id', '=', 'order_items.category_id')
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->join('areas', 'areas.id', '=', 'order_items.area_id')
            ->join('vendors', 'vendors.id', '=', 'order_items.vendor_id')
            ->where(['order_detail_id' => $id])->get();

        $orderDetail = DB::table('order_details')
            ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.delivery_date', 'order_details.delivery_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.created_at', 'order_details.staff_id', 'order_details.postCode', 'order_details.customerAddress')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            // ->join('staff', 'staff.id', '=', 'order_details.staff_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.id', $id)
            // ->orderBy('order_details.id', 'desc')
            ->get();

        // dd($orderItems);

        if ($id > 0 && $orderItems->count() == 0) {
            $result['orderItems'] = DB::table('order_items')->where(['order_detail_id' => $id])->get();
            $result['order_detail_id'] = $orderDetail['0']->id;
            $result['orderNo'] = $orderDetail['0']->orderNo;
            $result['user_id'] = $orderDetail['0']->user_id;
            $result['fname'] = $orderDetail['0']->fname;
            $result['lname'] = $orderDetail['0']->lname;
            $result['email'] = $orderDetail['0']->email;
            $result['city_name'] = $orderDetail['0']->city_name;
            $result['area_name'] = $orderDetail['0']->area_name;
            $result['pick_up_date'] = $orderDetail['0']->pick_up_date;
            $result['pick_up_time'] = $orderDetail['0']->pick_up_time;
            $result['city_id'] = $orderDetail['0']->city_id;
            $result['area_id'] = $orderDetail['0']->area_id;
            $result['customerAddress'] = $orderDetail['0']->customerAddress;
            // $result['postCode'] = $orderDetail['0']->postCode;
            // $result['customerAddress'] = $orderDetail['0']->customerAddress;
            return view('admin.pages.manage_orderManagerAddItems', compact('phoneNos', 'cities', 'areas', 'result', 'items', 'vendors', 'service_category', 'service_items', 'orderItems', 'staffInfo'));
        } else {
            $result['order_detail_id'] = $orderDetail['0']->id;
            $result['orderNo'] = $orderDetail['0']->orderNo;
            $result['user_id'] = $orderDetail['0']->user_id;
            $result['fname'] = $orderDetail['0']->fname;
            $result['lname'] = $orderDetail['0']->lname;
            $result['email'] = $orderDetail['0']->email;
            $result['city_name'] = $orderDetail['0']->city_name;
            $result['area_name'] = $orderDetail['0']->area_name;
            $result['pick_up_date'] = $orderDetail['0']->pick_up_date;
            $result['pick_up_time'] = $orderDetail['0']->pick_up_time;
            $result['delivery_date'] = $orderDetail['0']->delivery_date;
            $result['delivery_time'] = $orderDetail['0']->delivery_time;
            $result['city_id'] = $orderDetail['0']->city_id;
            $result['area_id'] = $orderDetail['0']->area_id;
            $result['staff_id'] = $orderDetail['0']->staff_id;
            $result['postCode'] = $orderDetail['0']->postCode;
            $result['customerAddress'] = $orderDetail['0']->customerAddress;

            // echo '<pre>';
            // print_r($orderDetail);

            return view('admin.pages.manage_orderManager', compact('phoneNos', 'cities', 'areas', 'result', 'items', 'vendors', 'service_category', 'service_items', 'orderItems', 'staffInfo'));
        }
    }

    public function mange_itemProcess(Request $request, $id = '')
    {
        $cities = DB::table('locations')->get();

        $areas = DB::table('areas')->get();

        $phoneNos = DB::table('users')
            ->select('id', 'fname', 'lname', 'email', 'phone')
            ->orderBy('phone', 'desc')
            ->get();

        $items = DB::table('items')->where(['status' => 1])->get();

        $vendors = DB::table('vendors')->where(['status' => 1])->get();

        $service_category = DB::table('categories')->where(['status' => 1])->get();

        $service_items = DB::table('items')->where(['status' => 1])->get();

        $staffInfo = DB::table('staff')->where(['status' => 1])->get();

        $orderItems = DB::table('order_items')
            ->select('order_items.id as order_id', 'order_items.item_process','items.id as item_id', 'categories.id as categories_id', 'categories.name as category_name', 'items.name as item_name', 'items.price', 'order_items.qty', 'areas.id as area_id', 'areas.area_name', 'vendors.id as vendors_id', 'vendors.ven_name', 'vendors.ven_phone')
            ->join('order_details', 'order_details.id', '=', 'order_items.order_detail_id')
            ->join('categories', 'categories.id', '=', 'order_items.category_id')
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->join('areas', 'areas.id', '=', 'order_items.area_id')
            ->join('vendors', 'vendors.id', '=', 'order_items.vendor_id')
            ->where(['order_detail_id' => $id])->get();

        $orderDetail = DB::table('order_details')
            ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.delivery_date', 'order_details.delivery_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.created_at', 'order_details.staff_id', 'order_details.postCode', 'order_details.customerAddress')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            // ->join('staff', 'staff.id', '=', 'order_details.staff_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.id', $id)
            // ->orderBy('order_details.id', 'desc')
            ->get();

        // dd($orderItems);
        $result['order_detail_id'] = $orderDetail['0']->id;
        $result['orderNo'] = $orderDetail['0']->orderNo;
        $result['user_id'] = $orderDetail['0']->user_id;
        $result['fname'] = $orderDetail['0']->fname;
        $result['lname'] = $orderDetail['0']->lname;
        $result['email'] = $orderDetail['0']->email;
        $result['city_name'] = $orderDetail['0']->city_name;
        $result['area_name'] = $orderDetail['0']->area_name;
        $result['pick_up_date'] = $orderDetail['0']->pick_up_date;
        $result['pick_up_time'] = $orderDetail['0']->pick_up_time;
        $result['delivery_date'] = $orderDetail['0']->delivery_date;
        $result['delivery_time'] = $orderDetail['0']->delivery_time;
        $result['city_id'] = $orderDetail['0']->city_id;
        $result['area_id'] = $orderDetail['0']->area_id;
        $result['staff_id'] = $orderDetail['0']->staff_id;
        $result['postCode'] = $orderDetail['0']->postCode;
        $result['customerAddress'] = $orderDetail['0']->customerAddress;

        // echo '<pre>';
        // print_r($orderDetail);

        return view('admin.pages.manage_itemProcess', compact('phoneNos', 'cities', 'areas', 'result', 'items', 'vendors', 'service_category', 'service_items', 'orderItems', 'staffInfo'));
    }


    public function getCustomerOrderInfo($id)
    {
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
    public function remove_items(Request $request, $item_id, $item_detail_id)
    {
        DB::table('order_items')->where(['id' => $item_id])->delete();
        return redirect('orderDetail_orderManager/' . $item_detail_id);
    }


    public function checkoutManager($id)
    {
        $orderItems = DB::table('order_items')
            ->select('order_items.id as order_id', 'items.id as item_id', 'categories.id as categories_id', 'categories.name as category_name', 'items.name as item_name', 'items.price', 'order_items.qty', 'areas.id as area_id', 'areas.area_name', 'vendors.id as vendors_id', 'vendors.ven_name', 'vendors.ven_phone', 'users.id as user_id', 'users.fname', 'users.lname', 'order_details.id as order_details_id')
            ->join('order_details', 'order_details.id', '=', 'order_items.order_detail_id')
            ->join('categories', 'categories.id', '=', 'order_items.category_id')
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->join('areas', 'areas.id', '=', 'order_items.area_id')
            ->join('vendors', 'vendors.id', '=', 'order_items.vendor_id')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->where(['order_detail_id' => $id])->get();

        $order_detail_total = DB::table('order_items')
            ->select(DB::raw('SUM(items.price * order_items.qty) as grandTotal'))
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->where('order_detail_id', '=', $id)
            ->get();

        $user_order_details = DB::table('order_details')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'order_details.orderNo')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->where('order_details.id', $id)
            ->get();

        $user_id = DB::table('order_details')
            ->select('user_id')
            ->where('order_details.id', $id)
            ->get();

        $checkoutInfo = DB::table('checkout_infos')
            ->where('checkout_infos.user_id', $user_id[0]->user_id)
            ->where('checkout_infos.order_detail_id', $id)
            ->get();

        $staffInfo = DB::table('staff')->get();

        // echo '<pre>';
        // print_r($staffInfo);
        // die();

        return view('admin.pages.checkout', compact('orderItems', 'user_order_details', 'checkoutInfo', 'order_detail_total', 'staffInfo'));
    }


    public function processManager($id)
    {
        $cities = DB::table('locations')->get();

        $areas = DB::table('areas')->get();

        $phoneNos = DB::table('users')
            ->select('id', 'fname', 'lname', 'email', 'phone')
            ->orderBy('phone', 'desc')
            ->get();

        $items = DB::table('items')->where(['status' => 1])->get();

        $vendors = DB::table('vendors')->where(['status' => 1])->get();

        $service_category = DB::table('categories')->where(['status' => 1])->get();

        $service_items = DB::table('items')->where(['status' => 1])->get();

        $staffInfo = DB::table('staff')->where(['status' => 1])->get();

        $orderItems = DB::table('order_items')
            ->select('order_items.id as order_id', 'items.id as item_id', 'categories.id as categories_id', 'categories.name as category_name', 'items.name as item_name', 'items.price', 'order_items.qty', 'areas.id as area_id', 'areas.area_name', 'vendors.id as vendors_id', 'vendors.ven_name', 'vendors.ven_phone')
            ->join('order_details', 'order_details.id', '=', 'order_items.order_detail_id')
            ->join('categories', 'categories.id', '=', 'order_items.category_id')
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->join('areas', 'areas.id', '=', 'order_items.area_id')
            ->join('vendors', 'vendors.id', '=', 'order_items.vendor_id')
            ->where(['order_detail_id' => $id])->get();

        $orderDetail = DB::table('order_details')
            ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.delivery_date', 'order_details.delivery_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.created_at', 'order_details.staff_id')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            // ->join('staff', 'staff.id', '=', 'order_details.staff_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.id', $id)
            // ->orderBy('order_details.id', 'desc')
            ->get();


        $totalDue = DB::table('checkout_infos')
            ->select('due')
            ->where(['order_detail_id' => $id])
            ->get();

        // dd($totalDue[0]->due);

        $result['order_detail_id'] = $orderDetail['0']->id;
        $result['orderNo'] = $orderDetail['0']->orderNo;
        $result['user_id'] = $orderDetail['0']->user_id;
        $result['fname'] = $orderDetail['0']->fname;
        $result['lname'] = $orderDetail['0']->lname;
        $result['email'] = $orderDetail['0']->email;
        $result['city_name'] = $orderDetail['0']->city_name;
        $result['area_name'] = $orderDetail['0']->area_name;
        $result['pick_up_date'] = $orderDetail['0']->pick_up_date;
        $result['pick_up_time'] = $orderDetail['0']->pick_up_time;
        $result['delivery_date'] = $orderDetail['0']->delivery_date;
        $result['delivery_time'] = $orderDetail['0']->delivery_time;
        $result['city_id'] = $orderDetail['0']->city_id;
        $result['area_id'] = $orderDetail['0']->area_id;
        $result['staff_id'] = $orderDetail['0']->staff_id;

        // echo '<pre>';
        // print_r($orderDetail);

        return view('admin.pages.itemProcess', compact('phoneNos', 'cities', 'areas', 'result', 'items', 'vendors', 'service_category', 'service_items', 'orderItems', 'staffInfo', 'totalDue'));

        // return view('admin.pages.itemProcess');
    }


    public function updateCheckoutQty(Request $request, $id)
    {
        // echo'<pre>';
        // print_r($request->all());
        // die();


        DB::table('order_items')
            ->where(['id' => $id])
            ->update(array('qty' => $request->post('qty')));

        $updateItems = DB::table('order_items')
            ->where(['id' => $id])->get();

        if ($updateItems) {
            return response()->json([
                'data' => $updateItems
            ]);
        }
    }

    public function getTotalPrice($id)
    {
        $getItemsBy_orderDetailsId = DB::table('order_items')

            // ->select('order_items.id as order_id', 'items.id as item_id', 'items.price', 'order_items.qty')
            ->select(DB::raw('(items.price* order_items.qty) as orderRate'), 'items.price', 'order_items.qty')
            ->leftjoin('items', 'items.id', '=', 'order_items.item_id')
            // ->where(['id' => $request->post('order_id')])
            ->where(['order_detail_id' => $id])
            ->get();
        // ->sum('orderRate');

        // echo'<pre>';
        // print_r($getItemsBy_orderDetailsId);
        // die();

        if ($getItemsBy_orderDetailsId) {
            return response()->json([
                'data' => $getItemsBy_orderDetailsId
            ]);
        }
    }


    public function addCheckoutDetail(Request $request)
    {

        // dd($request->all());

        $checkoutInfo = new CheckoutInfo();
        $checkoutInfo->user_id  = $request->post('user_id');
        $checkoutInfo->order_detail_id = $request->post('order_details_id');
        // $checkoutInfo->staff_id = $request->post('staffId');
        $checkoutInfo->grandTotal = $request->post('gtotal');
        $checkoutInfo->paid = $request->post('pnow');
        $checkoutInfo->due = $request->post('due');
        $checkoutInfo->status = 1;

        $collectionDue = DB::table('checkout_infos')
            ->where(['order_detail_id' => $request->post('order_details_id')])
            ->first();

        if (empty($collectionDue->paid)) {
            $result = $checkoutInfo->save();
        } else {

            $updateCheckoutInfo = CheckoutInfo::find($collectionDue->id);

            $paid = $collectionDue->paid + $request->post('pnow');
            $due = $collectionDue->due - $request->post('pnow');

            $updateCheckoutInfo->paid = $paid;
            $updateCheckoutInfo->due = $due;

            if ($updateCheckoutInfo->grandTotal == $updateCheckoutInfo->paid) {
                $updateCheckoutInfo->update(array('status' => 0));
            }

            $result = $updateCheckoutInfo->update();


        }

        if ($result) {
            return response()->json([
                'message' => "Inserted Successfully.",
                'data' => $result,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error.",
                'status' => 500
            ]);
        }

        // return redirect('collectionManager');
    }

    public function paymentInfo()
    {
        $collectionInfo = DB::table('checkout_infos')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'order_details.id as order_id', 'order_details.orderNo', 'checkout_infos.grandTotal', 'checkout_infos.paid', 'checkout_infos.due', 'checkout_infos.created_at')
            ->join('users', 'users.id', '=', 'checkout_infos.user_id')
            ->join('order_details', 'order_details.id', '=', 'checkout_infos.order_detail_id')
            ->where('checkout_infos.status',1)
            ->get();


        // echo '<pre>';
        // print_r($collectionInfo);
        // die();
        return view('admin.pages.paymentManager', compact('collectionInfo'));
    }

    public function collectionManager()
    {
        $collectionInfo = DB::table('checkout_infos')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'order_details.id as order_id', 'order_details.orderNo', 'checkout_infos.grandTotal', 'checkout_infos.paid', 'checkout_infos.due', 'checkout_infos.created_at')
            ->join('users', 'users.id', '=', 'checkout_infos.user_id')
            ->join('order_details', 'order_details.id', '=', 'checkout_infos.order_detail_id')
            ->where('checkout_infos.status',0)
            ->get();


        // echo '<pre>';
        // print_r($collectionInfo);
        // die();
        return view('admin.pages.collectionManager', compact('collectionInfo'));
    }

    public function customerInfo($id)
    {

        $orderDetail = DB::table('order_details')
            ->select('order_details.id', 'users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.phone', 'locations.id as city_id', 'locations.city_name', 'areas.id as area_id', 'areas.area_name', 'order_details.orderNo', 'order_details.required_services', 'order_details.pick_up_date', 'order_details.pick_up_time', 'order_details.delivery_date', 'order_details.delivery_time', 'order_details.pay_type', 'order_details.message', 'order_details.picked_up', 'order_details.created_at', 'order_details.staff_id', 'order_details.postCode', 'order_details.customerAddress')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('areas', 'areas.id', '=', 'order_details.area_id')
            ->join('staff', 'staff.id', '=', 'order_details.staff_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->where('order_details.user_id', $id)

            ->get();

        if ($orderDetail) {
            return response()->json([
                'message' => "Inserted Successfully.",
                'data' => $orderDetail,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error.",
                'status' => 500
            ]);
        }
    }

    public function itemInProcess(Request $request)
    {
        $result = OrderItem::where('id', $request->id)->update(array('item_process' => '1'));
        if ($result) {
            return response()->json([
                'message' => "Data Found.",
                'data' => $result,
                'state' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error.",
                'state' => 500
            ]);
        }
    }

    // public function itemComplete(Request $request)
    // {
    //     $result = OrderItem::where('id', $request->id)->update(array('item_process' => '1'));
    //     if ($result) {
    //         return response()->json([
    //             'message' => "Data Found.",
    //             'data' => $result,
    //             'state' => 200
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => "Internal Server Error.",
    //             'state' => 500
    //         ]);
    //     }
    // }
}
