<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bannertype;
// use App\Setting;
// use App\Category;
use App\Info;
// use App\Promo;
class HomeController extends Controller
{

    public function __construct()
    {
    }

    // public function index()
    // {
    //     $setting = Setting::first();
    //     $hpSliders = Bannertype::where('bannertype', 'Home Page Sliders')->first();
    //     $banners = Bannertype::where('bannertype', 'Home Page Banners')->first();
    //     $infoboxes = Info::orderBy('display_order')->limit(3)->get();
    //     $promos = Promo::orderBy('display_order')->limit(10)->get();
    //     $category = new Category;
    //     return view('home', [
    //             'setting' => $setting,
    //             'hpSliders' => $hpSliders,
    //             'infoboxes' => $infoboxes,
    //             'promos' => $promos,
    //             'banners' => $banners,
    //             'categories' => $category->allCategories()
    //         ]
    //     );
    // }

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
}
