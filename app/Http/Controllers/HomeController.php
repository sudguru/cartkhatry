<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bannertype;
use App\Info;
use App\Product;

class HomeController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        
        $hpSliders = Bannertype::where('bannertype', 'Home Page Sliders')->first();
        $banners = Bannertype::where('bannertype', 'Home Page Banners')->first();
        $infoboxes = Info::orderBy('display_order')->limit(3)->get();
        return view('home', [
                'hpSliders' => $hpSliders,
                'infoboxes' => $infoboxes,
                'banners' => $banners
            ]
        );
    }

    public function quickview(Product $product) {
        return view('quickview', compact('product'));
    }

    public function singleproduct(Product $product) {
        return view('singleproduct', compact('product'));
    }
}
