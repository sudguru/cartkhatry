<?php

namespace App\Http\Controllers\Admin;

use App\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutletController extends Controller
{

    protected $active = "Basic";

    public function index(Request $request) {
  
        $outlets = Outlet::orderBy('outlet')->get();
        return view('admin.outlet.index', [
            'outlets' => $outlets, 
            'active' => $this->active,
            ]);
    }

    public function destroy() {
        Outlet::destroy(request('id'));
        return back()->with('success','Outlet deleted successfully.');
    }

    public function create(Request $request)
    {
        return view('admin.outlet.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        Outlet::create([
            'outlet' => $request->outlet,
            'contact_person' => $request->contact_person,
            'description' => $request->description,
            'slug' => str_slug($request->outlet, '-'),
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'viber' => $request->viber,
            'whatsapp' => $request->whatsapp,
            'skype' => $request->skype,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
        return redirect()->route('outlet.index')->with('success','Outlet Added Successfully.');
    }

    public function edit(Outlet $outlet)
    {
        return view('admin.outlet.edit', ['outlet' => $outlet, 'active' => $this->active]);
    }

    public function update(Request $request, Outlet $outlet)
    {
        $validatedData = $this->validateRequest($request);
        $outlet->update([
            'outlet' => $request->outlet,
            'contact_person' => $request->contact_person,
            'description' => $request->description,
            'slug' => str_slug($request->outlet, '-'),
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'viber' => $request->viber,
            'whatsapp' => $request->whatsapp,
            'skype' => $request->skype,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
  
        return redirect()->route('outlet.index')
                        ->with('success','Outlet updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'outlet' => 'required|min:2',
            'contact_person' => 'required|min:2',
            'email' => 'nullable|email'
        ]);
    }


}
