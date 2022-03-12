<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class LocationController extends Controller
{

    // Testing

    public function index()
    {
        return view('admin.pages.cities');
    }

    // // End Testing

    // public function cities()
    // {
    //     return view('backend.pages.cities');
    // }

    public function storeCity(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cityName' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->message(),
            ]);
        } else {
            // Checking City name exist or not
            $cities = $request->all();
            $cityCount = Location::where('city_name', $cities['cityName']);
            if ($cityCount->count()) {
                return response()->json([
                    'status' => 400,
                    'message' => $cities['cityName'] . ' Already exist.',
                ]);
            } else {
                $location = new Location();
                $location->city_name = $request->input('cityName');
                $location->status = 1;
                $location->save();
                return response()->json([
                    'status' => 200,
                    'message' => $cities['cityName'] . ' added successfully',
                ]);
            }
        }
    }

    public function fetchCities()
    {
        // $locations = Location::all();
        $locations = DB::table('locations')
            ->orderBy('city_name', 'asc')
            ->get();
           
        return response()->json([
            'data' => $locations,
        ]);
    }

    public function editCity($id)
    {
        $city = Location::find($id);
        if ($city) {
            return response()->json([
                'status' => 200,
                'city' => $city,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'City Not Found.',
            ]);
        }
    }
    public function editStatusToInactive(Request $request)
    {
        $result = Location::where('id', $request->id)->update(array('status' => '0'));
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
        $result = Location::where('id', $request->id)->update(array('status' => '1'));

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


    public function updateCity(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city_name' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'City field can not be empty',
            ]);
        } else {
            $city = Location::find($id);
            if ($city) {
                $city->city_name = $request->input('city_name');
                $city->update();
                return response()->json([
                    'status' => 200,
                    'message' => $city['city_name'] . ' Updated successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => "City Not found",
                ]);
            }
        }
    }

    public function deleteCityByID(Request $request)
    {
        $result = Location::where('id', $request->id)->delete();
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
