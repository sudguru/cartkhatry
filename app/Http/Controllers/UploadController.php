<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;
use App\Pic;
// use App\File;
use Response;
use App\Product;
use Debugbar;

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
		Debugbar::info($request->product_id);
		//Save to table
		$pic = Pic::create([
            'pic_path' => $basename,
			'user_id' => auth()->user()->id,
			'lg' => $lg,
			'md' => $md,
			'sm' => $sm,
			'xs' => $xs
			]);

		$path = '/storage/images/'. auth()->user()->id . '/' . 'thumb_240/'. $basename;

		//return STATUS , Message , Path, Available Sizes
		return json_encode(array('message' => 'BceOk', 'success' => true, 'path' => $path, 'basename' => $basename, 'pic_id' => $pic->id, 'lg' => $lg, 'md' => $md, 'sm' => $sm, 'xs' => $xs));
    }

    public function savecaption(Request $request) {

		$product = Product::find($request->product_id);
		$display_order = $product->pics()->count() + 1;
		$picId = $request->pic_id;
		$caption = $request->caption;
		$hasPic = $product->pics()->where('pic_id', $picId)->exists();
		if(!$hasPic) {
			$product->pics()->attach($picId, ["caption" => $caption, 'display_order' => $display_order]);
			return 'true';
		} else {
			return 'false';
		}

		
	}

	public function removePic(Request $request) {
		$product = Product::find($request->product_id);
		$picId = $request->pic_id;
		$product->pics()->detach($picId);
		return json_encode(array('message' => 'BceOk'));
	}

	public function searchimage()
	{

		$s = request('s');
		$res = [];
		$userpics = Pic::where('user_id', auth()->user()->id)->get();
		foreach($userpics as $pic) {
			$productpics = $pic->products;
			foreach($productpics as $productpic)
			$p = stripos($productpic->pivot->caption, $s);
			if( $p !== false) {
				$obj = new \stdClass;
				$obj->id = $pic->id;
				$obj->pic_path = $pic->pic_path;
				$obj->lg = $pic->lg;
				$obj->md = $pic->md;
				$obj->sm = $pic->sm;
				$obj->xs = $pic->xs;
				$obj->caption = $productpic->pivot->caption;
				array_push($res, $obj);
			}
		}
		return $res;

	}
	
	public function imagesort(Request $request) {
		$product = Product::find($request->product_id);
		$productpics = $product->pics;
		$order = $request->order;
		$x = "";
		foreach($productpics as $productpic) {
			$key = array_search($productpic->pivot->pic_id, $order);
			$x .= $key . ",";
			$productpic->pivot->display_order = $key + 1;
			$productpic->pivot->save();
		} 

		return response()->json($x, 200);
		
    }
}
