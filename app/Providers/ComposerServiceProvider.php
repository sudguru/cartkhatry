<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Paymentmethod;
class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        View::composer([
                'account.product.add',
                'account.product.edit',
                'layouts.d11',
                'home',
                'singleproduct'
            ], 
            '\App\Http\ViewComposers\CommonComposer'
        );


        View::composer('account.info', function ($view) {
            $paymentmethods = Paymentmethod::orderBy('display_order')->get();
            $view->with('paymentmethods', $paymentmethods);
        });
    }

    public function register()
    {
        $this->app->singleton('\App\Http\ViewComposers\CommonComposer', function ($app) {
            return new \App\Http\ViewComposers\CommonComposer;
        });
    }


}