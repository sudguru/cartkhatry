<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Productprice;
use App\Category;
use App\Brand;
use App\Setting;
use App\Size;
use App\Country;

class MerchantController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function productcreate() {
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();
        $countries = Country::all();
        return view('account.productadd', [
            'currentPage' => 'merchantnewproduct',
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting,
            'countries' => $countries
        ]);
    }

    public function productindex() {
        $products = Product::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        return view('account.productindex')->withProducts($products)->with(['currentPage' => 'merchangeproducts']);
    }

    public function productstore(Request $request) {
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
            'manufactured_in' => $request->manufactured_in
        ]);
        $product->update([
            'slug' => $product->id . '-' . str_slug($request->name, '-')
        ]);
        return redirect()->route('account.product.edit', $product->slug)->with('success','Product Added Successfully, Now Add Product Image(s)');
    }

    public function productedit(Product $product) {
        $userpics = auth()->user()->pics;
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();
        $sizes = Size::orderBy('display_order')->get();
        $countries = Country::all();
        return view('account.productedit', [
            'currentPage' => 'merchantnewproduct',
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting,
            'userpics' => $userpics,
            'product' => $product,
            'sizes' => $sizes,
            'countries' => $countries
        ]);
    }

    public function productupdate(Request $request, Product $product) {
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
            'manufactured_in' => $request->manufactured_in
        ]);
        return redirect()->route('account.product.edit', $product->slug)->with('success', 'Product Updated Successfully');
    }

    
    public function productdestroy($p) {
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



    public function deleteprice() {
        Productprice::destroy(request('price_id'));
        return request('price_id');
    }
}
