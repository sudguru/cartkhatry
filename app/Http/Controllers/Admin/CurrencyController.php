<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    protected $active = "Products";

    public function index() {
        $currencies = Currency::orderBy('symbol')->get();
        return view('admin.currency.index', ['currencies' => $currencies, 'active' => $this->active]);
    }
    public function destroy() {
        Currency::destroy(request('id'));
        return back()->with('success','Currency deleted successfully.');
    }

    public function create()
    {
        return view('admin.currency.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        Currency::create([
            'symbol' => $request->symbol
        ]);
        return redirect()->route('currency.index')->with('success','Currency Added Successfully.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currency.edit', ['currency' => $currency, 'active' => $this->active]);
    }

    public function update(Request $request, Currency $currency)
    {
        $this->validateRequest($request);
        $currency->update([
            'symbole' => $request->symbole,
        ]);
  
        return redirect()->route('currency.index')
                        ->with('success','Currency updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'symbol' => 'required|min:3|max:3'
        ]);
    }

}
