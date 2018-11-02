<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SettingController extends Controller
{
    protected $active = "Settings";

    public function index(Request $request) {

        $setting = Setting::first();
        return view('admin.setting.edit', ['setting' => $setting, 'active' => $this->active]);
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
            'skype' => $request->skype
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
