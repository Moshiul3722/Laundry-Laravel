<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorsController extends Controller
{
    public function index()
    {
        $cities = DB::table('locations')
            ->orderBy('city_name', 'asc')
            ->get();
        $areas = DB::table('areas')
            ->orderBy('area_name', 'asc')
            ->get();
        return view('admin.pages.vendors', compact('cities', 'areas'));
    }
    public function storeVendor(Request $request)
    {

        $vendorCount = DB::table('vendors')
            ->where('ven_name', $request->input('vendor_name'))
            ->where('shop_name', $request->shop_name)
            ->get();

        if ($vendorCount->count()) {
            return response()->json([
                'status' => 400,
                'message' => $request->vendor_name . ' Already exist.',
            ]);
        } else {
            $vendor = new Vendor();
            $vendor->area_id  = $request->area_id;
            $vendor->ven_name = $request->vendor_name;
            $vendor->ven_phone = $request->vendor_phone;
            $vendor->shop_name = $request->shop_name;
            $vendor->shop_address = $request->shop_address;
            $vendor->status = 1;
            $result = $vendor->save();
            if ($result) {
                return response()->json([
                    'message' => $request->vendor_name . "Inserted Successfully.",
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => "Internal Server Error.",
                    'status' => 500
                ]);
            }
        }
    }

    public function getVendors()
    {
        $vendors = DB::table('vendors')
            ->select('vendors.id', 'vendors.ven_name', 'vendors.ven_phone', 'vendors.shop_name', 'vendors.shop_address', 'vendors.status', 'areas.id as area_id', 'areas.area_name')
            ->join('areas', 'areas.id', '=', 'vendors.area_id')
            ->orderBy('vendors.id', 'desc')
            ->get();

        // echo '<pre>';
        // print_r($vendors);
        // die();

        if ($vendors) {
            return response()->json([
                'message' => "Data Found.",
                'data' => $vendors,
                'state' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error.",
                'state' => 500
            ]);
        }
    }

    public function editVendor(Request $request)
    {
        // $result = Vendor::where('id', $request->id)->first();

        $result = DB::table('vendors')->where("vendors.id", $request->id)
            ->select('vendors.id', 'vendors.ven_name', 'vendors.ven_phone', 'vendors.shop_name', 'vendors.shop_address', 'vendors.status', 'areas.id as area_id', 'areas.area_name', 'locations.city_name', 'locations.id as city_id')
            ->join('areas', 'areas.id', '=', 'vendors.area_id')
            ->join('locations', 'locations.id', '=', 'areas.city_id')
            ->first();

        if ($result) {
            return response()->json([
                'message' => "Vendor Edited Successfully.",
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



    public function editStatusToInactive(Request $request)
    {
        $result = Vendor::where('id', $request->id)->update(array('status' => '0'));
        if ($result) {
            return response()->json([
                'data' => $result
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error.",
                'state' => 500
            ]);
        }
    }
    public function editStatusToActive(Request $request)
    {
        $result = Vendor::where('id', $request->id)->update(array('status' => '1'));

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

    public function updateVendor(Request $request, $id)
    {
        $vendor = Vendor::find($id);

        if ($request->input('area_id') == null) {
            $vendor->ven_phone = $request->input('vendor_phone');
            $vendor->ven_name = $request->input('vendor_name');
            $vendor->shop_name = $request->input('shop_name');
            $vendor->shop_address = $request->input('shop_address');
            $vendor->update();
        } else {
            $vendor->area_id  = $request->input('area_id');
            $vendor->ven_phone = $request->input('vendor_phone');
            $vendor->ven_name = $request->input('vendor_name');
            $vendor->shop_name = $request->input('shop_name');
            $vendor->shop_address = $request->input('shop_address');
            $vendor->update();
        }

        return response()->json([
            'status' => 200,
            'message' => $vendor['vendor_name'] . ' Updated successfully',

        ]);
    }

    public function deleteVendorByID(Request $request)
    {
        $result = Vendor::where('id', $request->id)->delete();
        if ($result) {
            return response()->json([
                'message' => "Data Deleted Successfully.",
                'state' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error.",
                'data' => $result,
                'state' => 500
            ]);
        }
    }
}
