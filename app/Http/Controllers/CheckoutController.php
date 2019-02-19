<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Productprice;
use App\Country;
use App\Tblorder;
use App\Tblorderdetail;
use Illuminate\Support\Facades\Mail;

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
        $order = Tblorder::create([
            'user_id' => \Auth::user()->id ?? 0,
            'merchant_id' => $product->user_id,
            'email' => $request->email,
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
        Tblorderdetail::create([
            'tblorder_id' => $order->id,
            'product_id' => $product->id,
            'qty' => $qty,
            'rate' => $price->discounted
        ]);

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
