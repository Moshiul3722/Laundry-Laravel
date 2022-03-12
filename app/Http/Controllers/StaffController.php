<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.staffManager');
    }


    public function storeStaff(Request $request)
    {
        $staffCount = DB::table('staff')
            ->where('staff_phone', $request->input('staff_phone'))
            ->get();
        if ($staffCount->count()) {
            return response()->json([
                'status' => 400,
                'message' => $request->staff_phone . ' Already exist.',
            ]);
        } else {
            $staff = new Staff();
            $staff->staff_name  = $request->staff_name;
            $staff->staff_phone = $request->staff_phone;
            $staff->staff_role = $request->staff_desig;
            $staff->address = $request->staff_address;
            $staff->status = 1;
            $result = $staff->save();
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

    public function getStaffs()
    {
        $stafffs = DB::table('staff')->get();

        if ($stafffs) {
            return response()->json([
                'message' => "Data Found.",
                'data' => $stafffs,
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
        $result = Staff::where('id', $request->id)->update(array('status' => '0'));
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
        $result = Staff::where('id', $request->id)->update(array('status' => '1'));

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

    public function editStaff(Request $request)
    {
        $result = DB::table('staff')->where("id", $request->id)->first();

        if ($result) {
            return response()->json([
                'message' => "Staff Edited Successfully.",
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

    public function updateStaff(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->staff_name  = $request->input('staff_name');
        $staff->staff_phone = $request->input('staff_phone');
        $staff->staff_role = $request->input('staff_desig');
        $staff->address = $request->input('staff_address');
        $staff->update();

        return response()->json([
            'status' => 200,
            'message' => ' Updated successfully',

        ]);
    }


    public function deleteStaffByID(Request $request)
    {
        $result = Staff::where('id', $request->id)->delete();
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
