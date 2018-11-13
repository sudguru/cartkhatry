<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;
use App\Pic;
// use App\File;
use Response;

class UploadController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function upload(Request $request) {
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=240',
			]);
		$image = $request->file('photo');
		$fsizes = ['1200' , '800' , '400' , '240'];
		$time = time();
        $imagename = $time.'.'.$image->getClientOriginalExtension();


		//original
		$path = request()->file('photo')->storeAs('public/images/'. auth()->user()->id .'/original', $imagename);


		//thumbs
		$lg = $md = $sm = $xs = 0;
		for($i = 0; $i < count($fsizes); $i++)
		{
			Storage::makeDirectory('public/images/'. auth()->user()->id .'/thumb_' . $fsizes[$i]);
			$input['imagename'] = $imagename;
			$destinationPath = storage_path('app/public/images/'. auth()->user()->id .'/thumb_'. $fsizes[$i]);
			$img[$i] = Image::make($image->getRealPath());
			$width = $img[$i]->width();
			if($width >= $fsizes[$i]) {
				$img[$i]->resize($fsizes[$i], $fsizes[$i], function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath.'/'.$input['imagename']);
				if($i == 0) $lg = 1;
				if($i == 1) $md = 1;
				if($i == 2) $sm = 1;
				if($i == 3) $xs = 1;
			}
		}
		$basename = basename($path);

		//Save to table
		$display_order = Pic::where('product_id', $request->product_id)->whereNull('deleted')->count() + 1;
		$pic = Pic::create([
            'pic_path' => $basename,
			'product_id' => $request->product_id,
			'user_id' => auth()->user()->id,
			'lg' => $lg,
			'md' => $md,
			'sm' => $sm,
			'xs' => $xs,
			'display_order' => $display_order
			]);

		$path = '/storage/images/'. auth()->user()->id . '/' . 'thumb_240/'. $basename;

		//return STATUS , Message , Path, Available Sizes
		return json_encode(array('message' => 'BceOk', 'success' => true, 'path' => $path, 'basename' => $basename, 'pic_id' => $pic->id, 'lg' => $lg, 'md' => $md, 'sm' => $sm, 'xs' => $xs));
    }

    public function savecaption(Request $request) {

		$pic = Pic::find($request->pic_id);
		$display_order = $pic->display_order;
		if ($display_order == 0) {
			$display_order = Pic::where('product_id', $request->product_id)->whereNull('deleted')->count() + 1;
		}
		$pic->update([
			'caption' => $request->caption,
			'deleted' => null,
			'display_order' => $display_order
		]);
		return json_encode(array('message' => 'BceOk'));
	}

	public function destroy(Request $request) {
		$pic = Pic::find($request->pic_id);
		$pic->update([
			'display_order' => 0,
			'deleted' => 1
		]);
		return json_encode(array('message' => 'BceOk'));
	}

	public function searchimage()
	{

		$s = request('s');
		$pics = Pic::where('caption', 'LIKE', '%'.$s.'%')->where('user_id', auth()->user()->id)->get();
		return $pics;
	}
	
	public function imagesort(Request $request) {
		$order = $request->order;
        foreach ($order as $key => $value) {
            $p = Pic::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
