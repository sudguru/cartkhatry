<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paymentmethod;
class SettingController extends Controller
{
    protected $active = "Settings";

    public function index(Request $request) {

        $setting = Setting::first();
        $paymentmethods = Paymentmethod::orderBy('display_order')->get();
        return view('admin.setting.edit', ['setting' => $setting, 'active' => $this->active, 'paymentmethods' => $paymentmethods]);
    }


    public function update(Request $request, Setting $setting)
    {
        $this->validateRequest($request);
        $setting->update([
            'site_name' => $request->site_name,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'address' => $request->address,
            'email' => $request->email,
            'order_email' => $request->order_email,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'googleplus' => $request->googleplus,
            'viber' => $request->viber,
            'youtube' => $request->youtube,
            'whatsapp' => $request->whatsapp,
            'skype' => $request->skype,
            'delivery_charge_local' => $request->delivery_charge_local,
            'delivery_charge_intercity' => $request->delivery_charge_intercity,
            'delivery_charge_intl' => $request->delivery_charge_intl,
            'payment_methods' => implode(",", $request->payment_methods),
            'bank_info' => $request->bank_info
        ]);
  
        return redirect()->route('setting.index')
                        ->with('success','Setting updated successfully');
    }



    private function validateRequest(Request $request) {
        return $request->validate([
            'email' => 'nullable|email',
        ]);
    }


}
