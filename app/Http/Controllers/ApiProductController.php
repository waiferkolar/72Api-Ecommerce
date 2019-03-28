<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

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
}
