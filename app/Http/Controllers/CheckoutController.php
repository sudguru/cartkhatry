<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Productprice;
use App\Country;
use App\Tblorder;
use App\Tblorderdetail;
use Illuminate\Support\Facades\Mail;
use App\Exchangerate;

class CheckoutController extends Controller
{
    public function directcheckout(Product $product, $qty, $priceid) {
        $price = Productprice::find($priceid);
        $countries = Country::all();
        return view('checkout-direct', [
            'product' => $product,
            'qty' => $qty,
            'price' => $price,
            'countries' => $countries
        ]);
    }

    public function directorder(Request $request, Product $product, $priceid, $qty) {
        //validate
        $this->validateRequest($request);
        //save to order if guest user_id = 0
        $price = Productprice::find($priceid);
        $currency = session('currency') ?? 'NPR';
        $order = Tblorder::create([
            'user_id' => \Auth::user()->id ?? 0,
            'merchant_id' => $product->user_id,
            'email' => $request->email,
            'currency' => $currency,
            'name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'postalcode' => $request->postalcode,
            'phone' => $request->phone,
            'qty' => $qty,
            'total' => $price->discounted * $qty
        ]);
        //save to order detail
        $exchangerates = Exchangerate::first();
        $productCurrency = $product->primarycurrency;
        Tblorderdetail::create([
            'tblorder_id' => $order->id,
            'product_id' => $product->id,
            'productname' => $item['item']->name,
            'qty' => $qty,
            'rate' => round(($price->discounted/$exchangerates->$productCurrency) * $exchangerates->$currency)
        ]);
        
        round(($orderdetail->rate/$exchangerates->$itemcurrency) * $exchangerates->$cur, 2);
        //send mail to merchant
        $salution_vendor = '<h2>Hello ' . $product->user->name .'</h2>';
        $salution_client = '<h2>Hello ' . $request->name .'</h2>';
        $body .= '<p>The following order has been placed via <a href="http://khatryonline.com">www.khatryOnline.com</a><p>';
        $body .= '<p><strong>' . $product->name . '</strong><br>';
        $body .= 'Quantity: ' . $qty . '<br>';
        $body .= 'Rate: ' . $price->discounted. '<br></p>';
        $body .= 'Total: ' . $order->total. '<br></p>';
        $body .= '<p><strong>Delivery Address</strong></p>';
        $body .= '<small>Name</small>: ' . $request->name . '<br/>';
        $body .= '<small>Company</small>: ' . $request->company . '<br/>';
        $body .= '<small>Address</small>: ' . $request->address . '<br/>';
        $body .= '<small>City</small>: ' . $request->city . '<br/>';
        $body .= '<small>Country</small>: ' . $request->country . '<br/>';
        $body .= '<small>State</small>: ' . $request->state . '<br/>';
        $body .= '<small>Postal Code</small>: ' . $request->postalcode . '<br/>';
        $body .= '<small>Phone/ Mobile</small>: ' . $request->phone . '<br/>';
        $body .= '<p>Please understand that you are solely responsible in dealing with the concerning party regarding this order via khatryOnline. KhatryOnline.com is in no way responsible for this transaction';
        
        $body = $salution_vendor . $body;
        Mail::send([], [], function ($message) use ($product, $order, $body) {
            $message->to($product->user->email)
            ->cc('thirdpartyorder@khatryonline.com')
                ->subject($product->name . " order via Khatry Online (Vendor Copy)")
                ->setBody($body , 'text/html'); // for HTML rich messages
        });
        $body = $salution_client . $body;
        Mail::send([], [], function ($message) use ($product, $order, $body) {
            $message->to($order->email)
            ->cc('thirdpartyorder@khatryonline.com')
                ->subject($product->name . " order via Khatry Online (Client Copy)")
                ->setBody($body , 'text/html'); // for HTML rich messages
        });
        //send mail to customer
        //successful direct order page

        return redirect()->route('ordersuccessdirect', ['order' => $order, 'product' => $product->slug]);
    }

    public function ordersuccessdirect(Tblorder $order, Product $product) {
        return view('ordersuccessdirect', [
            'order' => $order,
            'product' => $product
        ]);
    }

    public function checkout() {
        $countries = Country::all();
        return view('checkout', [
            'countries' => $countries
        ]);
    }
    

    public function cartorder(Request $request) {
        //validate
        $this->validateRequest($request);
        $currency = session('currency') ?? 'NPR';
        $order = Tblorder::create([
            'user_id' => \Auth::user()->id ?? 0,
            'merchant_id' => 6,
            'email' => $request->email,
            'currency' => $currency,
            'name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'postalcode' => $request->postalcode,
            'phone' => $request->phone,
            'qty' => session('cart')->totalQty,
            'total' => session('cart')->totalPrice
        ]);
        //save to order detail
        $products_text = "";
        $exchangerates = Exchangerate::first();
        foreach(session('cart')->items as $item) {
            $productCurrency = $item['item']->currency;
            Tblorderdetail::create([
                'tblorder_id' => $order->id,
                'product_id' => $item['item']->id,
                'productname' => $item['item']->name,
                'qty' => $item['qty'],
                'rate' => round(($item['item']->price/$exchangerates->$productCurrency) * $exchangerates->$currency)
            ]);
            $products_text.= "
            <tr><td>{{$item['item']->name}}</td>
            <td>{{$item['qty']}}</td>
            <td>{{$item['item']->price}}</td>
            <td>{{$item['price']}}</td></tr>";
        }
        //send mail to merchant
        $salution_vendor = '<h2>Order to Khatry Online</h2>';
        $salution_client = '<h2>Hello ' . $request->name .'</h2>';
        $body = '<p>The following order has been placed to <a href="http://khatryonline.com">www.khatryOnline.com</a><p>';
        $body .= 'Order Details<br/><table><tr><td>Product</td><td>Qty</td>Rate</td><td>Total</td></tr>';
        $body .= $products_text;
        $body .= '</table>';
        $body .= '<p><strong>Delivery Address</strong></p>';
        $body .= '<small>Name</small>: ' . $request->name . '<br/>';
        $body .= '<small>Company</small>: ' . $request->company . '<br/>';
        $body .= '<small>Address</small>: ' . $request->address . '<br/>';
        $body .= '<small>City</small>: ' . $request->city . '<br/>';
        $body .= '<small>Country</small>: ' . $request->country . '<br/>';
        $body .= '<small>State</small>: ' . $request->state . '<br/>';
        $body .= '<small>Postal Code</small>: ' . $request->postalcode . '<br/>';
        $body .= '<small>Phone/ Mobile</small>: ' . $request->phone . '<br/>';
        $body .= '<p>Please understand that you are solely responsible in dealing with the concerning party regarding this order via khatryOnline. KhatryOnline.com is in no way responsible for this transaction';
        
        $body = $salution_vendor . $body;
        // Mail::send([], [], function ($message) use ($product, $order, $body) {
        //     $message->to('orders@khatryonline.com')
        //         ->subject("Order to Khatry Online")
        //         ->setBody($body , 'text/html'); // for HTML rich messages
        // });
        // $body = $salution_client . $body;
        // Mail::send([], [], function ($message) use ($product, $order, $body) {
        //     $message->to($order->email)
        //         ->subject("Your order to Khatry Online (Client Copy)")
        //         ->setBody($body , 'text/html'); // for HTML rich messages
        // });
        //send mail to customer
        //successful direct order page
        $request->session()->forget('cart');
        return redirect()->route('ordersuccess', ['order' => $order]);
    }

    public function ordersuccess(Tblorder $order) {
        return view('ordersuccess', [
            'order' => $order
        ]);
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'postalcode' => 'required',
            'city' => 'required',
            'phone' => 'required'

        ]);
    }
}
