<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Bannertype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    protected $active = "Basic";
    // protected $positions = array(
    //     array('name' => 'Home Slider', 'needsTitle' => true, 'needsSubtitle' => true),
    //     array('name' => 'Home Banners', 'needsTitle' => false, 'needsSubtitle' => false)
    // );
    public function index(Request $request) {
        $bannertype_id = $request->query('bannertype_id');
        if($bannertype_id) {
            $banners = Banner::where('bannertype_id', $bannertype_id)->orderBy('display_order')->get();
        } else {
            $banners = Banner::orderBy('created_at', 'desc')->get();
        }
        $bannertypes = Bannertype::orderBy('bannertype')->get();
        return view('admin.banner.index', [
            'banners' => $banners,
            'active' => $this->active,
            'bannertypes' => $bannertypes,
            'bannertype_id' => $bannertype_id
        ]);
    }

    public function destroy() {
        Banner::destroy(request('id'));
        return back()->with('success','Banner deleted successfully.');
    }

    public function create(Request $request)
    {
        $bannertype_id = $request->query('bannertype_id');
        $bannertypes = Bannertype::orderBy('bannertype')->get();
        return view('admin.banner.add', ['active' => $this->active, 'bannertypes' => $bannertypes, 'bannertype_id' => $bannertype_id]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Banner::where('bannertype_id', $request->bannertype_id)->count() + 1;
        
        $image = $request->file('banner');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/banners', $filename);

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'bannertype_id' => $request->bannertype_id,
            'banner' => $filename,
            'display_order' => $display_order
        ]);
        return redirect()->route('banner.index',['bannertype_id' => $request->bannertype_id])->with('success','Banner Added Successfully.');
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
            'banner' => 'required|image|mimes:jpeg,png,jps,gif,svg|max:1024',
            'bannertype_id' => 'required|not_in:0',
            'link' => 'nullable|url',
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

}
