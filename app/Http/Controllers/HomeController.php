<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bannertype;
use App\Info;
use App\Product;
use App\Category;

class HomeController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        
        $hpSliders = Bannertype::where('bannertype', 'HP Sliders')->first();
        $bannersH1 = Bannertype::where('bannertype', 'HP Banners R1')->first();
        $bannersH2 = Bannertype::where('bannertype', 'HP Banners R2')->first();
        $bannersH3 = Bannertype::where('bannertype', 'HP Banners R3')->first();
        $bannersV = Bannertype::where('bannertype', 'HP Banners Vert')->first();
        $infoboxes = Info::orderBy('display_order')->limit(3)->get();
        return view('home', [
                'hpSliders' => $hpSliders,
                'infoboxes' => $infoboxes,
                'bannersH1' => $bannersH1,
                'bannersH2' => $bannersH2,
                'bannersH3' => $bannersH3,
                'bannersV' => $bannersV,
            ]
        );
    }

    public function quickview(Product $product) {
        return view('quickview', compact('product'));
    }

    public function singleproduct(Product $product) {
        return view('singleproduct', compact('product'));
    }

    public function category(Category $category) {
        return view('category');
    }
}
