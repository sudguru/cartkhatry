<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
class BrandController extends Controller
{
    protected $active = "Basic";
    public function index() {
        $brands = Brand::orderBy("display_order")->get();
        return view('admin.brand.index')->with(['active' => $this->active, 'brands' => $brands]);
    }
}
