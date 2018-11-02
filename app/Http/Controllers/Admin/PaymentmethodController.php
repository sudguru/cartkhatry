<?php

namespace App\Http\Controllers\Admin;

use App\Paymentmethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentmethodController extends Controller
{
    protected $active = "Products";
    public function index() {
        $paymentmethods = Paymentmethod::orderBy('display_order')->get();
        return view('admin.paymentmethod.index', ['paymentmethods' => $paymentmethods, 'active' => $this->active]);
    }

    public function destroy() {
        Paymentmethod::destroy(request('id'));
        return back()->with('success','Paymentmethod deleted successfully.');
    }

    public function create()
    {
        return view('admin.paymentmethod.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Paymentmethod::count() + 1;
        Paymentmethod::create([
            'payment_method' => $request->payment_method,
            'slug' => str_slug($request->payment_method),
            'display_order' => $display_order
        ]);
        return redirect()->route('paymentmethod.index')->with('success','Paymentmethod Added Successfully.');
    }

    public function edit(Paymentmethod $paymentmethod)
    {
        return view('admin.paymentmethod.edit', ['paymentmethod' => $paymentmethod, 'active' => $this->active]);
    }

    public function update(Request $request, Paymentmethod $paymentmethod)
    {
        $this->validateRequest($request);
        $paymentmethod->update([
            'payment_method' => $request->payment_method,
            'slug' => str_slug($request->payment_method)
        ]);
  
        return redirect()->route('paymentmethod.index')
                        ->with('success','Paymentmethod updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'payment_method' => 'required|max:50'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Paymentmethod::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
