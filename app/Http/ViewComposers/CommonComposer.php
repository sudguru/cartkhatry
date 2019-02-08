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
use App\Exchangerate;

class CommonComposer
{


    public function compose(View $view)
    {

      $view->with('setting', Cache::remember('setting', 1, function() {
        return Setting::first();
      }));

      $view->with('exchangerates', Cache::remember('exchangerates', 1, function() {
        $exchangerates = Exchangerate::first();
        
        if($exchangerates->date < date('Y-m-d')) {
          // dd(date('Y-m-d') . " " . $exchangerates->date);
          $endpoint = 'latest';
          $access_key = '759976081e1de6365817e5d3053a88ac';

          // Initialize CURL:
          $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          // Store the data:
          $json = curl_exec($ch);
            // Decode JSON response:
          $res = json_decode($json, true);
          // dd($res['success']);
          if($res['success'] === true) {
            $date = $res['date'];
            $NPR = $res['rates']['NPR'];
            $EUR = $res['rates']['EUR'];
            $INR = $res['rates']['INR'];
            $USD = $res['rates']['USD'];
            $CAD = $res['rates']['CAD'];
            $AUD = $res['rates']['AUD'];
            $JPY = $res['rates']['JPY'];
            $CNY = $res['rates']['CNY'];
            $HKD = $res['rates']['HKD'];
            $KRW = $res['rates']['KRW'];
            $SGD = $res['rates']['SGD'];
            $CHF = $res['rates']['CHF'];
            $SEK = $res['rates']['SEK'];
            $DKK = $res['rates']['DKK'];
            $GBP = $res['rates']['GBP'];
            $er = Exchangerate::first();
            $er->update([
                'date' => $date,
                'NPR' => $NPR,
                'EUR' => $EUR,
                'INR' => $INR,
                'USD' => $USD,
                'CAD' => $CAD,
                'AUD' => $AUD,
                'JPY' => $JPY,
                'CNY' => $CNY,
                'HKD' => $HKD,
                'KRW' => $KRW,
                'SGD' => $SGD,
                'CHF' => $CHF,
                'SEK' => $SEK,
                'DKK' => $DKK,
                'GBP' => $GBP
            ]);
          }
          curl_close($ch);
          $exchangerates = Exchangerate::first();
        }
        
        return $exchangerates; 
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