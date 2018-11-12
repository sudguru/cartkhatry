<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $products = Product::where('user_id', auth()->user()->id)->get();
        return view('account.product.index')->withProducts($products)->with('currentPage', 'merchangeproducts');
    }
    public function create() {

        return view('account.product.add', [
            'currentPage' => 'merchantnewproduct'
        ]);
    }

    public function store(Request $request) {
        $this->validateRequest($request);
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'SKU' => $request->SKU,
            'description' => $request->description,
            'specification' => $request->specification,
            'user_id' => auth()->user()->id,
            'stock' => $request->stock,
            'min_order_unit' => $request->min_order_unit,
            'min_stock_level' => $request->min_stock_level
        ]);
        return redirect()->route('account.product.edit', $product->id)->with('success','Product Added Successfully, Now Add Product Image(s)');
    }

    public function edit(Product $product) {
        return view('account.product.edit', ['product' => $product, 'currentPage' => 'merchantnewproduct']);
    }

    public function update(Request $request, Product $product) {
        $this->validateRequest($request);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'SKU' => $request->SKU,
            'description' => $request->description,
            'specification' => $request->specification,
            'user_id' => auth()->user()->id,
            'stock' => $request->stock,
            'min_order_unit' => $request->min_order_unit,
            'min_stock_level' => $request->min_stock_level
        ]);
        return redirect()->route('account.product.index')->with('success', 'Product Updated Successfully');
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required',
            'SKU' => 'required',
            'stock' => 'required|numeric'
        ]);
    }
}
