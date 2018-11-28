<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
class BrandController extends Controller
{
    protected $active = "Products";
    public function index() {
        $brands = Brand::orderBy("display_order")->get();
        return view('admin.brand.index')->with(['active' => $this->active, 'brands' => $brands]);
    }

    public function destroy() {
        Brand::destroy(request('id'));
        return back()->with('success','Brand deleted successfully.');
    }

    public function create(Request $request)
    {
        return view('admin.brand.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Brand::count() + 1;
        
        $image = $request->file('pic_path');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/brands', $filename);

        Brand::create([
            'brand' => $request->brand,
            'description' => $request->description,
            'pic_path' => $filename,
            'display_order' => $display_order
        ]);

        return redirect()->route('brand.index')->with('success','Brand Added Successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', ['brand' => $brand, 'active' => $this->active]);
    }

    public function update(Request $request, Brand $brand)
    {

        $this->validateRequest($request);

        $filename = null;
        if($request->file('pic_path')) {
            $image = $request->file('pic_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/brands', $filename);
        } else {
            $filename = $brand->pic_path;
        }

        $brand->update([
            'brand' => $request->brand,
            'description' => $request->description,
            'pic_path' => $filename
        ]);
  
        return redirect()->route('brand.index')
                        ->with('success','Brand updated successfully');
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'pic_path' => 'nullable|image|mimes:jpeg,png,jps,gif,svg|max:1024',
            'brand' => 'required|max:30',
            'description' => 'nullable|max:300'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Brand::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
