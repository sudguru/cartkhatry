<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Productprice;
use App\Category;
use App\Brand;
use App\Setting;
use App\Size;
use App\Productcolor;

class ProductController extends Controller
{
    protected $active = "Products";

    public function index() {
        $products = Product::orderBy('updated_at', 'desc')->get();
        return view('admin.product.index')->withProducts($products)->with(['active' => $this->active]);
    }

    public function create() {
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();
        return view('admin.product.add', [
            'active' => $this->active,
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting
        ]);
    }

    public function store(Request $request) {
        $this->validateRequest($request);
        $product = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
            'name' => $request->name,
            'slug' => 'temp',
            'description' => $request->description,
            'specification' => $request->specification,
            'user_id' => auth()->user()->id,
            'last_modified_user_id' => auth()->user()->id,
            'delivery_available' => $request->delivery_available,
            'delivery_day_from' => $request->delivery_day_from,
            'delivery_day_to' => $request->delivery_day_to,
            'delivery_charge_local' => $request->delivery_charge_local,
            'delivery_charge_intercity' => $request->delivery_charge_intercity,
            'delivery_charge_intl' => $request->delivery_charge_intl
        ]);
        $product->update([
            'slug' => $product->id . '-' . str_slug($request->name, '-')
        ]);
        return redirect()->route('product.edit', $product->slug)->with('success','Product Added Successfully, Now Add Product Image(s)');
    }

    public function edit(Product $product) {
        $userpics = auth()->user()->pics;
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();
        $sizes = Size::orderBy('display_order')->get();
        return view('admin.product.edit', [
            'active' => $this->active,
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting,
            'userpics' => $userpics,
            'product' => $product,
            'sizes' => $sizes
        ]);
    }

    public function update(Request $request, Product $product) {
        $this->validateRequest($request);
        $product->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
            'name' => $request->name,
            'slug' => $product->id . '-' . str_slug($request->name, '-'),
            'description' => $request->description,
            'specification' => $request->specification,
            'last_modified_user_id' => auth()->user()->id,
            'delivery_available' => $request->delivery_available,
            'delivery_day_from' => $request->delivery_day_from,
            'delivery_day_to' => $request->delivery_day_to,
            'delivery_charge_local' => $request->delivery_charge_local,
            'delivery_charge_intercity' => $request->delivery_charge_intercity,
            'delivery_charge_intl' => $request->delivery_charge_intl
        ]);
        return redirect()->route('product.edit', $product->slug)->with('success', 'Product Updated Successfully');
    }

    
    public function destroy($p) {
        $product = Product::find($p);
        $product->prices()->delete();
        $product->pics()->detach();
        $product->delete();
        return back()->with('success','Product deleted successfully.');
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required'
        ]);
    }

    //Product Price

    public function saveprice(Request $request) {
 
        $productprice = Productprice::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'regular' => $request->regular,
            'discounted' => $request->discounted,
            'discount_valid_until' => $request->discount_valid_until
        ]);
        // $productprice = Productprice::create([
        //     'product_id' => $request->product_id,
        //     'size_id' => 1,
        //     'regular' => 0,
        //     'discounted' => 0
        // ]);
        return $productprice->id;   
    }

    public function updateprice(Request $request) {
        $field = $request->field;
        $id = $request->id;
        $value = $request->value;
        $productprice = Productprice::find($id);
        $productprice->update([
            $field => $value
        ]);
        return $id;
    }

    public function deleteprice() {
        Productprice::destroy(request('price_id'));
        return request('price_id');
    }

    public function addcolor() {
        // $pid = request('price_id');
        // $newcolor = request('newcolor');
        // $pp = Productprice::find($pid);
        // $colors = $pp->colors;
        // $pp->colors = $colors . "~" . $newcolor;
        // $pp->save();
        // return request('price_id');
        $productprice_id = request('price_id');
        $newcolor = request('newcolor');
        $sku = request('sku');
        $productcolor = Productcolor::create([
            'productprice_id' => $productprice_id,
            'color' => $newcolor,
            'sku' => $sku
        ]);

    }

    public function removecolor() {
        Productcolor::destroy(request('price_id'));
        return request('price_id');
    }
    
}
