<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    protected $active = "Basic";
    protected $positions = array(
        array('name' => 'Home Slider', 'needsTitle' => true, 'needsSubtitle' => true),
        array('name' => 'Home Banners', 'needsTitle' => false, 'needsSubtitle' => false)
    );
    public function index() {
        
        // $ao = new \ArrayObject($this->positions);
        // // dd($ao);
        // foreach($ao as $element) {
        //     echo $element['name'] . " f <br>";
        //     echo $element['needsTitle'] . " f<br>";
        //     echo $element['needsSubtitle'] . " f <br>";
        // }
        $banners = Banner::orderBy('display_order')->get();
        return view('admin.banner.index', ['banners' => $banners, 'active' => $this->active]);
    }

    public function destroy() {
        Banner::destroy(request('id'));
        return back()->with('success','Banner deleted successfully.');
    }

    public function create()
    {
        $positions = new \ArrayObject($this->positions);
        return view('admin.banner.add', ['active' => $this->active, 'positions' => $positions]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Banner::count() + 1;
        Banner::create([
            'title' => $request->title,
            'link' => $request->link,
            'display_order' => $display_order
        ]);
        return redirect()->route('banner.index')->with('success','Banner Added Successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', ['banner' => $banner, 'active' => $this->active]);
    }

    public function update(Request $request, Banner $banner)
    {
        $validatedData = $this->validateRequest($request);
        $banner->update($validatedData);
  
        return redirect()->route('banner.index')
                        ->with('success','Banner updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'title' => 'required|max:50',
            'link' => 'present|url',
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Banner::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }

    public function upload(Request $request) {
        $upload_dir = "../public/uploads/logos/";
        $photo = $request->dataUrl;
        $filename = rand(100000, 999999) . '-' . $request->filename;
        $img = str_replace('data:image/png;base64,', '', $photo);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace('data:image/gif;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imagedata = base64_decode($img);
        $file = $upload_dir . $filename;
        $success = file_put_contents($file, $imagedata);
        return response()->json($filename, 200);
    }
}
