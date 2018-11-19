<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $active = "Products";
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', [
            'active' => $this->active,
            'products' => $products
        ]);
    }


    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //category_order, Approved
    }


    public function update(Request $request, Product $product)
    {
        //category_order. Approved
        $product->update([
            'approved'=> $request->approved
        ]);
        return $request->approved;
    }

    public function destroy(Product $product)
    {
        //just in case
    }
}
