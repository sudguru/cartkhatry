<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
// use App\Bannertype;
use App\Setting;
use App\Category;
// use App\Info;
use App\Promo;
use App\Productlist;
use App\Outlet;

class CommonComposer
{


    public function compose(View $view)
    {

      $view->with('setting', Cache::remember('setting', 1, function() {
        return Setting::first();
      }));

      $view->with('promos', Cache::remember('promos', 1, function() {
        return Promo::orderBy('display_order')->limit(10)->get();
      }));

      $view->with('categories', Cache::remember('categories', 1, function() {
        $category = new Category;
        return $category->allCategories();
      }));

      $view->with('outlets', Cache::remember('outlets', 1, function() {
        return Outlet::orderBy("outlet")->get();
      }));

      $view->with('featureds', Cache::remember('featureds', 1, function() {
        return Productlist::where('listname', 'featured')->orderBy('display_order')->take(10)->get();
      }));

      $view->with('newarrivals', Cache::remember('newarrivals', 1, function() {
        return Productlist::where('listname', 'new')->orderBy('display_order')->take(10)->get();
      }));

    }


}