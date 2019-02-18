<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CheckoutController extends Controller
{
    public function directcheckout(Product $product, $qty) {
        dd($qty);
    }
}
