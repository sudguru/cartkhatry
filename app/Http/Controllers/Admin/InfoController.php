<?php

namespace App\Http\Controllers\Admin;

use App\Info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    protected $active = "Basic";

    public function index() {
        $infos = Info::orderBy('display_order')->get();
        return view('admin.info.index', ['infos' => $infos, 'active' => $this->active]);
    }

    public function destroy() {
        Info::destroy(request('id'));
        return back()->with('success','Info deleted successfully.');
    }

    public function create()
    {
        return view('admin.info.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Info::count() + 1;
        Info::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'icon' => $request->icon,
            'display_order' => $display_order
        ]);
        return redirect()->route('info.index')->with('success','Info Added Successfully.');
    }

    public function edit(Info $info)
    {
        return view('admin.info.edit', ['info' => $info, 'active' => $this->active]);
    }

    public function update(Request $request, Info $info)
    {
        $validatedData = $this->validateRequest($request);
        $info->update($validatedData);
  
        return redirect()->route('info.index')
                        ->with('success','Info updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'title' => 'required|max:50',
            'subtitle' => 'required|max:200',
            'icon' => 'required',
            'link' => 'nullable|url',
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Info::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
