<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
// use App\Bannertype;
use App\Setting;
use App\Category;
// use App\Info;
use App\Promo;

class CommonComposer
{


    public function compose(View $view)
    {
      $setting = Setting::first();
      $promos = Promo::orderBy('display_order')->limit(10)->get();
      $category = new Category;
      $categories = $category->allCategories();
      $view->with('setting', $setting)
          ->with('promos', $promos)
          ->with('categories', $categories);
    }
}