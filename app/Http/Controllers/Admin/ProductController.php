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
use App\Userdetail;
use App\Country;

class ProductController extends Controller
{
    protected $active = "Products";

    public function index() {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.index')->withProducts($products)->with(['active' => $this->active]);
    }

    public function create() {
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();
        $countries = Country::all();
        $sizes = Size::orderBy('display_order')->get();
        return view('admin.product.add', [
            'active' => $this->active,
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting,
            'countries' => $countries,
            'sizes' => $sizes
        ]);
    }

    public function store(Request $request) {
        $this->validateRequest($request);
        $product = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'paymentmanagedby' => $request->paymentmanagedby,
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
            'delivery_charge_intl' => $request->delivery_charge_intl,
            'manufactured_in' => $request->manufactured_in,
            'primarycurrency' => $request->primarycurrency
        ]);
        $product->update([
            'slug' => $product->id . '-' . str_slug($request->name, '-')
        ]);
        //save first product price
        $discounted = $request->discounted;
        if(is_null($discounted)) $discounted = $request->regular;
        Productprice::create([
            'product_id' => $product->id,
            'size_id' => $request->size_id,
            'regular' => $request->regular,
            'discounted' => $discounted,
            'discount_valid_until' => $request->discount_valid_until,
            'stock' => 1
        ]);
        return redirect()->route('product.edit', $product->slug)->with('success','Product Added Successfully, Now Add Product Image(s)');
    }

    public function edit(Product $product) {
        $userpics = auth()->user()->pics;
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();
        $sizes = Size::orderBy('display_order')->get();
        $countries = Country::all();
        return view('admin.product.edit', [
            'active' => $this->active,
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting,
            'userpics' => $userpics,
            'product' => $product,
            'sizes' => $sizes,
            'countries' => $countries
        ]);
    }

    public function update(Request $request, Product $product) {
        $this->validateRequest($request);
        $product->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'paymentmanagedby' => $request->paymentmanagedby,
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
            'delivery_charge_intl' => $request->delivery_charge_intl,
            'manufactured_in' => $request->manufactured_in,
            'primarycurrency' => $request->primarycurrency
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
            'discount_valid_until' => $request->discount_valid_until,
            'stock' => 1
        ]);
        return $productprice->id;   
    }

    public function updateprice(Request $request) {

        $id = $request->price_id;
        $productprice = Productprice::find($id);
        $productprice->update([
            'size_id' => $request->size_id,
            'regular' => $request->regular,
            'discounted' => $request->discounted,
            'discount_valid_until' => $request->discount_valid_until
        ]);
        return $id;
    }

    public function updatestock(Request $request) {
        $price_id = $request->price_id;
        $productprice = Productprice::find($price_id);
        $productprice->update([
            'stock' => $request->status,
        ]);
        return $request->status;
    }

    public function deleteprice() {
        Productprice::destroy(request('price_id'));
        return request('price_id');
    }

    
}
