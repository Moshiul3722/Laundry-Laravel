<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.pages.category');
    }

    public function addCategory(Request $request)
    {
        // Checking City name exist or not
        $categories = $request->all();
        $categoryCount = Category::where('name', $categories['category_name']);
        if ($categoryCount->count()) {
            return response()->json([
                'status' => 400,
                'message' => $categories['category_name'] . ' Already exist.',
            ]);
        } else {
            $category = new Category();
            $category->name = $request->category_name;
            $category->status = 1;
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => $categories['category_name'] . ' add successfully',
            ]);
        }
    }

    public function getCategories()
    {
        $categories = Category::all();
        // dd($vendors);
        if ($categories) {
            return response()->json([
                'message' => "Data Found.",
                'data' => $categories,
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
        $result = Category::where('id', $request->id)->update(array('status' => '0'));
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
        $result = Category::where('id', $request->id)->update(array('status' => '1'));

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

    public function editCategory(Request $request)
    {
        $result = Category::where('id', $request->id)->first();
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


    public function updateCategory(Request $request, $id)
    {

        // echo '<pre>';
        // print_r($request->all());
        // die();
        $category = Category::find($id);
        $category->name = $request->input('category_name');
        $category->update();

        return response()->json([
            'status' => 200,
            'message' => $category['name'] . ' Updated successfully',

        ]);



        $category = $request->all();
        $categoryCount = Category::where('name', $category['category_name']);
        if ($categoryCount->count()) {
            return response()->json([
                'status' => 400,
                'message' => $category['category_name'] . ' Already exist.',
            ]);
        } else {
            $category = Category::find($id);
            $category->name = $request->input('category_name');
            $category->update();
            return response()->json([
                'status' => 200,
                'message' => $category['item_name'] . ' Updated successfully',
            ]);
        }


    }

    public function deleteCategoryByID(Request $request)
    {
        $result = Category::where('id', $request->id)->delete();
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
