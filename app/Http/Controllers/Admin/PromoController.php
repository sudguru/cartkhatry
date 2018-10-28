<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promo;

class PromoController extends Controller
{
    protected $active = "Basic";
    public function index() {
        $promos = Promo::orderBy('display_order')->get();
        return view('admin.promo.index', ['promos' => $promos, 'active' => $this->active]);
    }

    public function destroy() {
        Promo::destroy(request('id'));
        return back()->with('success','Promo deleted successfully.');
    }

    public function create()
    {
        return view('admin.promo.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Promo::count() + 1;
        Promo::create([
            'title' => $request->title,
            'link' => $request->link,
            'display_order' => $display_order
        ]);
        return redirect()->route('promo.index')->with('success','Promo Added Successfully.');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promo.edit', ['promo' => $promo, 'active' => $this->active]);
    }

    public function update(Request $request, Promo $promo)
    {
        $validatedData = $this->validateRequest($request);
        $promo->update($validatedData);
  
        return redirect()->route('promo.index')
                        ->with('success','Promo updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'title' => 'required|max:50',
            'link' => 'required|url',
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Promo::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
