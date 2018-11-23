<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Size;
class SizeController extends Controller
{
    protected $active = "Products";

    public function index() {
        $sizes = Size::orderBy('display_order')->get();
        return view('admin.size.index', ['sizes' => $sizes, 'active' => $this->active]);
    }
    public function destroy() {
        Size::destroy(request('id'));
        return back()->with('success','Size deleted successfully.');
    }

    public function create()
    {
        return view('admin.size.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Size::count() + 1;
        Size::create([
            'size' => $request->size,
            'slug' => str_slug($request->size),
            'display_order' => $display_order
        ]);
        return redirect()->route('size.index')->with('success','Size Added Successfully.');
    }

    public function edit(Size $size)
    {
        return view('admin.size.edit', ['size' => $size, 'active' => $this->active]);
    }

    public function update(Request $request, Size $size)
    {
        $this->validateRequest($request);
        $size->update([
            'size' => $request->size,
            'slug' => str_slug($request->size)
        ]);
  
        return redirect()->route('size.index')
                        ->with('success','Size updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'size' => 'required|max:10'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Size::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
