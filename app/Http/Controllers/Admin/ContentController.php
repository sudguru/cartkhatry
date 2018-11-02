<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Contenttype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    protected $active = "Basic";

    public function index(Request $request) {
        $contenttype_id = $request->query('contenttype_id');
        if(!$contenttype_id) {
            $contenttype_id = Contenttype::orderBy('display_order')->first()->id;
        }

        $contents = Content::where('contenttype_id', $contenttype_id)->orderBy('display_order')->get();
        $contenttypes = Contenttype::orderBy('display_order')->get();
        return view('admin.content.index', [
            'contents' => $contents, 
            'active' => $this->active,
            'contenttypes' => $contenttypes,
            'contenttype_id' => $contenttype_id
            ]);
    }

    public function destroy() {
        Content::destroy(request('id'));
        return back()->with('success','Content deleted successfully.');
    }

    public function create(Request $request)
    {
        $contenttype_id = $request->query('contenttype_id');
        $contenttypes = Contenttype::orderBy('contenttype')->get();
        return view('admin.content.add', [
            'active' => $this->active,
            'contenttypes' => $contenttypes,
            'contenttype_id' => $contenttype_id
            ]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Content::where('contenttype_id', $request->contenttype_id)->count() + 1;
        Content::create([
            'title' => $request->title,
            'content' => $request->content,
            'display_order' => $display_order,
            'slug' => str_slug($request->title, '-'),
            'contenttype_id' => $request->contenttype_id
        ]);
        return redirect()->route('content.index',['contenttype_id' => $request->contenttype_id])->with('success','Content Added Successfully.');
    }

    public function edit(Content $content)
    {
        $contenttypes = Contenttype::orderBy('contenttype')->get();
        return view('admin.content.edit', ['content' => $content, 'active' => $this->active, 'contenttypes' => $contenttypes]);
    }

    public function update(Request $request, Content $content)
    {
        $validatedData = $this->validateRequest($request);
        $content->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => str_slug($request->title, '-'),
            'contenttype_id' => $request->contenttype_id
        ]);
  
        return redirect()->route('content.index', ['contenttype_id' => $request->contenttype_id])
                        ->with('success','Content updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'title' => 'required',
            'content' => 'required|min:2'
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
