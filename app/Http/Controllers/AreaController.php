<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        $cities = DB::table('locations')
            ->orderBy('city_name', 'asc')
            ->get();

        return view('admin.pages.areas', compact('cities'));
    }

    public function storeArea(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'area_name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => 'Area field can\'t empty',
            ]);
        } else {
            $areas = $request->all();
            $areaCount = Area::where('area_name', $areas['area_name']);
            if ($areaCount->count()) {
                return response()->json([
                    'status' => 400,
                    'message' => $areas['area_name'] . ' Already exist.',
                ]);
            } else {
                $area = new Area();
                $area->city_id = $request->input('city_id');
                $area->area_name = $request->input('area_name');
                $area->status = 1;
                $area->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Area added successfully',
                ]);
            }
        }
    }

    public function fetchAreas()
    {
        $areas = DB::table('areas')
            ->select("areas.id", "areas.area_name","areas.status", "locations.city_name")
            ->join("locations", "areas.city_id", "=", "locations.id")
            ->orderBy('city_name', 'asc')
            ->get();
        return response()->json([
            'data' => $areas,
        ]);
    }

    public function editArea($id)
    {
        // $area = Area::find($id);
        $area = DB::table('areas')->where("areas.id", $id)->select("areas.id", "areas.area_name", "locations.city_name")->join("locations", "areas.city_id", "=", "locations.id")
            ->get();
        if ($area) {
            return response()->json([
                'status' => 200,
                'area' => $area,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Area Not Found.',
            ]);
        }
    }

    public function updateArea(Request $request, $id)
    {
        $areas = $request->all();

        $areaCount = Area::where('area_name', $areas['areaName'])
            ->Where('city_id', $areas['selectedCity'])
            ->get();

        // echo '<pre>';
        // print_r($areaCount);
        // echo '</pre>';

        if ($areaCount->count()) {
            return response()->json([
                'status' => 4000,
                'message' => $areas['areaName'] . ' Or ' . $areas['selectedCity'] . ' Already exist.',
            ]);
        } else {
            $area = Area::find($id);

            // $city = DB::table('areas')->where("areas.id", $id)->select("areas.city_id")->join("locations", "areas.city_id", "=", "locations.id")->first();

            if ($request->input('selectedCity') == null) {
                $area->area_name = $request->input('areaName');
                $area->update();
            } else {
                $area->area_name = $request->input('areaName');
                $area->city_id = $request->input('selectedCity');
                $area->update();
            }

            return response()->json([
                'status' => 200,
                'message' => $area['areaName'] . ' Updated successfully',

            ]);
        }
    }

    public function editStatusToInactive(Request $request)
    {
        $result = Area::where('id', $request->id)->update(array('status' => '0'));
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
    public function editStatusToActive(Request $request)
    {
        $result = Area::where('id', $request->id)->update(array('status' => '1'));

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

    public function deleteAreaByID(Request $request)
    {
        $result = Area::where('id', $request->id)->delete();
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
