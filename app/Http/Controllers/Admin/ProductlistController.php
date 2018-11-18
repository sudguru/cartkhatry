<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Productlist;
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
        return view('admin.productlist.index', [
            'productlists' => $productlists,
            'active' => $this->active,
            'listname' => $listname
        ]);
    }

    public function create(Request $request) {
        $listname = $request->query('listname');
        return view('admin.producttype.add', ['active' => $this->active, 'listname' => $listname]);
    }
}
