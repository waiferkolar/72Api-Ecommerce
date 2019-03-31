<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function getProduct($cat)
    {
        $cats = Product::where('cat_id', $cat)->paginate(20);
        return response()->json($cats);
    }

    public function getAllCats()
    {
        $cats = Category::all();
        return response()->json($cats);
    }

    public function getSingleProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json($product);
    }

    public function newProduct(Request $request)
    {
        $cat_id = $request->get('cat_id');
        $name = $request->get('name');
        $price = $request->get('price');
        $image = $request->get('image');
        $description = $request->get('description');

        $product = new Product();
        $product->cat_id = $cat_id;
        $product->name = $name;
        $product->price = $price;
        $product->image = $image;
        $product->description = $description;
        $con = $product->save();
        $msg = $con == true ? "Product Uploaded Successfully" : "Product Upload Fail!";
        $msg = [
            "con" => $con,
            "msg" => $msg,
        ];
        return response()->json($msg);
    }

    public function imageUpload(Request $request)
    {
        $file = $request->file("image");

        $size = $file->getSize();

        $filename = $file->getClientOriginalName();

        $modify_file_name = uniqid() . "_" . $filename;

        $file->move($_SERVER['DOCUMENT_ROOT'] . "/uploads", $modify_file_name);

        return response()->json(["name" => $modify_file_name, "size" => $size]);
    }
    public function previewCart(Request $request)
    {
        $items = $request->get("items");
        $items = rtrim($items, ",");
        $productAry = explode(",", $items);

        $products = [];
        foreach ($productAry as $product) {
            $aay = explode("#", $product);
            $productId = $aay[0];
            $productCount = $aay[1];
            $productFromDB = Product::where('id', $productId)->first();
            $productFromDB["count"] = $productCount;
            array_push($products, $productFromDB);
        }
        return response()->json($products);
    }

}
