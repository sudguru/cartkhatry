<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
// use App\Productprice;
use App\Category;
use App\Brand;

class DashboardController extends Controller
{
    public function index() {
        return view('account.dashboard', [
            'currentPage' => 'dashboard'
        ]);
    }

    public function change() {
        \Auth::logout();
        return redirect('/password/reset');
    }

    public function create() {
        $category = new Category;
        $brands = Brand::orderBy('display_order')->get();
        // $setting = Setting::first();

        return view('account.productadd', [
            'currentPage' => 'merchantnewproduct',
            'categories' => $category->allCategories(),
            'brands' => $brands,
        ]);
    }
}
