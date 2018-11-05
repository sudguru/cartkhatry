<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Paymentmethod;
class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {

        View::composer(
            'layouts.site', 'App\Http\ViewComposers\CommonComposer'
        );


        View::composer('account.info', function ($view) {
            $paymentmethods = Paymentmethod::orderBy('display_order')->get();
            $view->with('paymentmethods', $paymentmethods);
        });
    }

    public function register()
    {
        //
    }
}