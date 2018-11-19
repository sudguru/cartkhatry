<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Productlist;
use App\Product;
use App\Http\Controllers\Controller;
class ProductlistController extends Controller
{
    protected $active = "Products";

    public function index(Request $request) {
        $listname = $request->query('listname');
        if(!$listname) {
            $listname = "New";
        }
        $productlists = Productlist::where('listname', $listname)->orderBy('display_order')->get();
        $products = Product::product_not_in_the_list_yet($listname);
        return view('admin.productlist.index', [
            'productlists' => $productlists,
            'active' => $this->active,
            'listname' => $listname,
            'products' => $products
        ]);
    }

    public function create(Request $request) {
        $listname = $request->query('listname');
        return view('admin.productlist.add', ['active' => $this->active, 'listname' => $listname]);
    }

    public function store(Request $request) {
        try {
            $list = Productlist::where('listname', $request->listname)->orderBy('display_order')->get();
            $newPL = Productlist::create([
                'product_id' => $request->product_id,
                'listname' => $request->listname,
                'display_order' => 1
            ]);
            foreach($list as $item) {
                $item->display_order = $item->display_order + 1;
                $item->save();
            }
            return json_encode(['token' => $request->_token, 'id' => $newPL->id, 'name' => $newPL->product['name']]);
        } catch (Exception $e) {
            return $e;
        }
        
    }

    public function destroy() {
        Productlist::destroy(request('id'));
        return back()->with('success','Item deleted successfully.');
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Productlist::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
