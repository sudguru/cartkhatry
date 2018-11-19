<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Productlist;
use App\Product;
use App\Http\Controllers\Controller;
class ProductlistController extends Controller
{
    protected $active = "Products";

    public function index(Request $request) {
        $listname = $request->query('listname');
        if(!$listname) {
            $listname = "New";
        }
        $productlists = Productlist::where('listname', $listname)->orderBy('display_order')->get();
        $products = Product::all();
        return view('admin.productlist.index', [
            'productlists' => $productlists,
            'active' => $this->active,
            'listname' => $listname,
            'products' => $products
        ]);
    }

    public function create(Request $request) {
        $listname = $request->query('listname');
        return view('admin.productlist.add', ['active' => $this->active, 'listname' => $listname]);
    }
}
