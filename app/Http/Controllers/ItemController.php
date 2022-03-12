<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        return view('admin.pages.items', compact('categories'));
    }


    public function addItem(Request $request)
    {
        // Checking Item exist or not
        $items = $request->all();
        $itemsCount = Item::where('name', $items['item_name'])
            ->Where('category_id', $items['category_id'])
            ->get();

        if ($itemsCount->count()) {
            return response()->json([
                'status' => 400,
                'message' => $items['item_name'] . ' Already exist.',
            ]);
        } else {
            $item = new Item();
            $item->name = $request->item_name;
            $item->category_id = $request->category_id;
            $item->price = $request->price;
            $item->status = 1;
            $item->save();
            return response()->json([
                'status' => 200,
                'message' => $item['item_name'] . ' add successfully',
            ]);
        }
    }

    public function getItems()
    {
        $items = DB::table('items')
            ->select("items.id", "items.name", "items.status", "items.price", "categories.name as category_name")
            ->join("categories", "items.category_id", "=", "categories.id")
            // ->orderBy('items.id', 'asc')
            ->get();

        // echo '<pre>';
        // print_r($items);
        // echo '</pre>';

        if ($items) {
            return response()->json([
                'message' => "Data Found.",
                'data' => $items,
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
        $result = Item::where('id', $request->id)->update(array('status' => '0'));
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
        $result = Item::where('id', $request->id)->update(array('status' => '1'));

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

    public function editItem(Request $request)
    {
        $result = DB::table('items')
            ->select("items.id", "items.name", "items.status", "items.price", "categories.name as category_name")
            ->join("categories", "items.category_id", "=", "categories.id")
            ->where("items.id", $request->id)
            // ->orderBy('items.id', 'asc')
            ->first();
        // $result = Item::where('id', $request->id)->first();
        if ($result) {
            return response()->json([
                'message' => "Item Edited Successfully.",
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


    public function updateItem(Request $request, $id)
    {
        $items = $request->all();

        // echo '<pre>';
        // print_r($items);
        // echo '</pre>';

        $itemsCount = Item::where('name', $items['item_name'])
            ->Where('category_id', $items['category_id'])
            ->get();

        if ($itemsCount->count()) {
            return response()->json([
                'status' => 4000,
                'message' => $items['item_name'] . ' Or ' . $items['price'] . ' Already exist.',
            ]);
        } else {
            $item = Item::find($id);
            if ($request->input('category_id') == null) {
                $item->name = $request->input('item_name');
                $item->price = $request->input('price');
                $item->update();
            } else {
                $item->name = $request->input('item_name');
                $item->category_id = $request->input('category_id');
                $item->price = $request->input('price');
                $item->update();
            }

            return response()->json([
                'status' => 200,
                'message' => $item['item_name'] . ' Updated successfully',
            ]);
        }
    }

    public function deleteItemByID(Request $request)
    {
        $result = Item::where('id', $request->id)->delete();
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
