<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Productprice;
use Session;
class CartController extends Controller
{
    public function addtocart(Request $request, Product $product, Productprice $price, $qty) {
        //product images
        if(count($product->pics) > 0) {
            $image_path = '<img src="/storage/images/'.$product['user_id'].'/thumb_400'.'/' . $product->pics->first()->pic_path .'" />';
        } else {
            $image_path = $image_path = '<img src="/assets/images/product-placeholder.jpg" />';
            
        }
        //prepare product for cart
        $productForCart = new \stdClass();
        $productForCart->id = $product->id;
        $productForCart->name = $product->name;
        $productForCart->slug = $product->slug;
        $productForCart->price = $price->discounted;
        $productForCart->currency = $product->primarycurrency;
        $productForCart->pic = $image_path;
        $productForCart->qty = $qty;
        $productForCart->size = $price->size->size;

        $cartIndex = $productForCart->id . $productForCart->size;
        // echo 'hascart' . $request->session()->has('cart');
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        // echo 'oldcart' . $oldCart;
        $cart = new Cart($oldCart);
        $cart->add($productForCart, $cartIndex);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        return back();
    }

    public function viewcart() {
        return view('cart');
    }
}
