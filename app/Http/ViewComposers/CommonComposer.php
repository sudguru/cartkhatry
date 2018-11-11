<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
// use App\Bannertype;
use App\Setting;
use App\Category;
// use App\Info;
use App\Promo;

class CommonComposer
{
    private $setting;
    private $promos;
    private $categories;
    

    // public function compose(View $view)
    // {
    //   if (!$this->setting) {
    //     $this->setting = Setting::first();
    //     $this->promos = Promo::orderBy('display_order')->limit(10)->get();
    //     $category = new Category;
    //     $this->categories = $category->allCategories();
    //   }
    //   return $view->with('setting', $this->setting)
    //       ->with('promos', $this->promos)
    //       ->with('categories', $this->categories);
    // }

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

    }


}