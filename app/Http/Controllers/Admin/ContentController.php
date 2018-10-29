<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    protected $active = "Basic";
    public function index() {
        $contents = Content::orderBy('display_order')->get();
        return view('admin.content.index', ['contents' => $contents, 'active' => $this->active]);
    }

    public function destroy() {
        Content::destroy(request('id'));
        return back()->with('success','Content deleted successfully.');
    }

    public function create()
    {
        return view('admin.content.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Content::count() + 1;
        Content::create([
            'content' => $request->content,
            'display_order' => $display_order
        ]);
        return redirect()->route('content.index')->with('success','Content Added Successfully.');
    }

    public function edit(Content $content)
    {
        return view('admin.content.edit', ['content' => $content, 'active' => $this->active]);
    }

    public function update(Request $request, Content $content)
    {
        $validatedData = $this->validateRequest($request);
        $content->update($validatedData);
  
        return redirect()->route('content.index')
                        ->with('success','Content updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'content' => 'required|max:50'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Content::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
