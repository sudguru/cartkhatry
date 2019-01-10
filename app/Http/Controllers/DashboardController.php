<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
// use App\Productprice;
use App\Category;
use App\Brand;
use App\Userdetail;
use App\Setting;
use App\Size;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $userdetail = Userdetail::firstOrCreate(
            ['id' => auth()->user()->id],
            [
                'is_admin' => 0,
                'is_super' => 0
            ]
        );

        return view('account.dashboard', [
            'currentPage' => 'dashboard',
            'userdetail' => $userdetail
        ]);
    }

    public function change() {
        \Auth::logout();
        return redirect('/password/reset');
    }

    public function productcreate() {
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        $setting = Setting::first();

        return view('account.productadd', [
            'currentPage' => 'merchantnewproduct',
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting
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
            'delivery_charge_intl' => $request->delivery_charge_intl
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
        return view('account.productedit', [
            'currentPage' => 'merchantnewproduct',
            'categories' => $category->allCategories(),
            'brands' => $brands,
            'setting' => $setting,
            'userpics' => $userpics,
            'product' => $product,
            'sizes' => $sizes
        ]);
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required'
        ]);
    }
}
