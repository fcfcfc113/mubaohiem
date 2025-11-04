<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Banner;


class ProductController extends Controller
{
    public function show()
    {
        $product_list = Product::all()->toArray();
        $banners = Banner::where('status', 1)->get()->toArray();
        return view('products.show', compact('product_list', 'banners'));
    }

    public function getData(Request $request)
    {
        $products = Product::all()->toArray();
        return response()->json($products);
    }
    public function getDataReviews(Request $request)
    {
        $reviews = Review::all()->toArray();
        return response()->json($reviews);
    }
}
