<?php

namespace App\Http\Controllers\Admin;

use App\Contenttype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContenttypeController extends Controller
{
    protected $active = "Basic";
    public function index() {
        $contenttypes = Contenttype::orderBy('display_order')->get();
        return view('admin.contenttype.index', ['contenttypes' => $contenttypes, 'active' => $this->active]);
    }

    public function destroy() {
        Contenttype::destroy(request('id'));
        return back()->with('success','Contenttype deleted successfully.');
    }

    public function create()
    {
        return view('admin.contenttype.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Contenttype::count() + 1;
        Contenttype::create([
            'contenttype' => $request->contenttype,
            'icon' => $request->icon,
            'display_order' => $display_order
        ]);
        return redirect()->route('contenttype.index')->with('success','Contenttype Added Successfully.');
    }

    public function edit(Contenttype $contenttype)
    {
        return view('admin.contenttype.edit', ['contenttype' => $contenttype, 'active' => $this->active]);
    }

    public function update(Request $request, Contenttype $contenttype)
    {
        $validatedData = $this->validateRequest($request);
        $contenttype->update($validatedData);
  
        return redirect()->route('contenttype.index')
                        ->with('success','Contenttype updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'contenttype' => 'required|max:50',
            'icon' => 'required|max:50'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Contenttype::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
