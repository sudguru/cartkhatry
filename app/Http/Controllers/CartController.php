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
        $productForCart->rate = $price->discounted; //
        $productForCart->primarycurrency = $product->primarycurrency; //
        $productForCart->pic = $image_path;
        $productForCart->qty = $qty; //
        $productForCart->sizeslug = $price->size->slug;
        $productForCart->size = $price->size->size;

        $cartIndex = $productForCart->id . $productForCart->slug;
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($productForCart, $cartIndex);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        return back();
    }

    public function viewcart() {
        return view('cart');
    }

    public function cartremoveitem(Request $request, $itemindex){
        // $request->session('cart')->forget($itemindex);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
 
        $cart = new Cart($oldCart);
        $cart->remove($itemindex);
        $request->session()->put('cart', $cart);
        $newcart = $request->session()->get('cart');
        if($newcart->totalQty == 0) {
            $request->session()->forget('cart');
        }
        return back();
    }

    public function clearcart(Request $request) {
        $request->session()->forget('cart');
        return back();
    }
}
