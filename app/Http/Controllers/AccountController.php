<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userdetail;
use App\User;

class AccountController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $userdetail = Userdetail::firstOrCreate(
            ['id' => auth()->user()->id],
            [
                'is_admin' => 0,
                'is_super' => 0,
                'vendor_level' => 'NotYet'
            ]
        );

        return view('account.info', [
            'currentPage' => 'accountinfo',
            'userdetail' => $userdetail
        ]);
    }

    public function update(Request $request) {
        $this->validateRequest($request);
        $name = request('name');
        $user = User::find(auth()->user()->id);
        $user->name = $name;
        $user->save();

        $userdetail = Userdetail::find(auth()->user()->id);
        $userdetail->update([
            'company_name' => $request->company_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'fax' => $request->fax,
            'website' => $request->website,
            'description' => $request->description,
            'payment_methods' => "[" . implode(",", $request->payment_methods) . "]",
            'bank_info' => $request->bank_info
        ]);


        return redirect()->route('account.info')
            ->with('success','Promo updated successfully');
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required'
        ]);
    }
}
