<?php

namespace App\Http\Controllers\Admin;

use App\Bannertype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannertypeController extends Controller
{
    protected $active = "Basic";
    public function index() {
        $bannertypes = Bannertype::orderBy('display_order')->get();
        return view('admin.bannertype.index', ['bannertypes' => $bannertypes, 'active' => $this->active]);
    }

    public function destroy() {
        Bannertype::destroy(request('id'));
        return back()->with('success','Bannertype deleted successfully.');
    }

    public function create()
    {
        return view('admin.bannertype.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Bannertype::count() + 1;
        Bannertype::create([
            'bannertype' => $request->bannertype,
            'display_order' => $display_order,
            'needsTitle' => $request->needsTitle,
            'needsSubtitle' => $request->needsSubtitle
        ]);
        return redirect()->route('bannertype.index')->with('success','Bannertype Added Successfully.');
    }

    public function edit(Bannertype $bannertype)
    {
        return view('admin.bannertype.edit', ['bannertype' => $bannertype, 'active' => $this->active]);
    }

    public function update(Request $request, Bannertype $bannertype)
    {
        $validatedData = $this->validateRequest($request);
        $bannertype->update([
            'bannertype' => $request->bannertype,
            'needsTitle' => $request->needsTitle,
            'needsSubtitle' => $request->needsSubtitle
        ]);
  
        return redirect()->route('bannertype.index')
                        ->with('success','Bannertype updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'bannertype' => 'required|max:50'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Bannertype::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
