<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.create-product');
    }

    public function createProduct(Request $request)
    {
        Product::create([
            "name" => $request->get("name"),
            "description" =>  $request->get("description"),
            "quantity" => $request->get("quantity"),
            "price" => $request->get("price"),
            "user_id" => strtolower(str_replace(' ', '', auth()->user()->name))
        ]);

        return response()->json([
            "success" => true,
            "message" => "Product Created Successfully"
        ]);
    }

    public function viewProducts()
    {
        $products = Product::orderBy('created_at',  'DESC')->get();
        return response()->json([
            "products" => $products,
            "user" => auth()->user(),
            "success" => true
        ]);
    }

    public function viewProduct($id)
    {
        $product = Product::where('id', $id)->first();

        return response()->json([
            "product" => $product,
            "user" => auth()->user(),
            "success" => true
        ]);
    }

    public function singleProductView($id)
    {
        $user = auth()->user();
        $uid = strtolower(str_replace(' ', '', $user->name));
        $user_id = $user->id;
        $product_owner = Product::where('id', $id)->first()->user_id;
        return view('products.product', compact('id', 'uid', 'user_id', 'product_owner'));
    }
}
