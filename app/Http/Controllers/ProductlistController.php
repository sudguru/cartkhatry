<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Productlist;
class ProductlistController extends Controller
{
    public function index() {
        $listname = $request->query('listname');
        if(!$listname) {
            $listname = "New";
        }
        $productlists = Productlist::where('listname', $listname)->orderBy('display_order')->get();
        return view('admin.banner.index', [
            'productlists' => $productlists,
            'active' => $this->active,
            'bannertypes' => $bannertypes,
            'listname' => $listname
        ]);
    }
}
