<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Productprice;

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
            'slug' => str_slug($request->name, '-'),
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
        $userpics = auth()->user()->pics;
        return view('account.product.edit', ['product' => $product, 'userpics' => $userpics, 'currentPage' => 'merchantnewproduct']);
    }

    public function update(Request $request, Product $product) {
        $this->validateRequest($request);
        $product->update([
            'name' => $request->name,
            'slug' => str_slug($request->name, '-'),
            'category_id' => $request->category_id,
            'SKU' => $request->SKU,
            'description' => $request->description,
            'specification' => $request->specification,
            'user_id' => auth()->user()->id,
            'stock' => $request->stock,
            'min_order_unit' => $request->min_order_unit,
            'min_stock_level' => $request->min_stock_level
        ]);
        return redirect()->route('account.product.edit', $product->id)->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product) {

        $product->prices()->delete();
        $product->pics()->detach();
        $product->delete();
        return back()->with('success','Product deleted successfully.');
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required',
            'SKU' => 'required',
            'stock' => 'required|numeric'
        ]);
    }

    //Product Price

    public function saveprice(Request $request) {
 
        $productprice = Productprice::create([
            'product_id' => $request->product_id,
            'attributes' => $request->txtattributes,
            'regular' => $request->regular,
            'discounted' => $request->discounted,
            'discount_valid_until' => $request->discount_valid_until
        ]);
        return $productprice->id;   
    }

    public function deleteprice() {
        Productprice::destroy(request('price_id'));
        return request('price_id');
    }

    public function addcolor() {
        $pid = request('price_id');
        $newcolor = request('newcolor');
        $pp = Productprice::find($pid);
        $colors = $pp->colors;
        $pp->colors = $colors . "~" . $newcolor;
        $pp->save();
        return request('price_id');
    }

    public function removecolor() {
        $pid = request('price_id');
        $colortoremove = request('colortoremove');
        $pp = Productprice::find($pid);
        $colors = $pp->colors;
        $colors = str_replace($colortoremove, "", $colors);
        $pp->colors = $colors;
        $pp->save();
        return $colortoremove;
    }
    
}
