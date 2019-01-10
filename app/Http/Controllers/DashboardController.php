<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
// use App\Productprice;
use App\Category;
use App\Brand;
use App\Userdetail;

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
        // $setting = Setting::first();

        return view('account.productadd', [
            'currentPage' => 'merchantnewproduct',
            'categories' => $category->allCategories(),
            'brands' => $brands,
        ]);
    }

    public function productindex() {
        $products = Product::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        return view('account.productindex')->withProducts($products)->with(['currentPage' => 'merchangeproducts']);
    }
}
