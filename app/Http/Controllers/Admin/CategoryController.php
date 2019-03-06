<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $active = "Products";
    public function index() {
        $category = new Category;
        $categories = $category->allCategories();
        return view('admin.category.index', ['categories' => $categories, 'active' => $this->active]);
    }

    public function destroy() {
        Category::destroy(request('id'));
        return back()->with('success','Category deleted successfully.');
    }



    public function store(Request $request)
    {
        $data = json_decode($request->jsondata);
        $x = "";
        $displayOrder = 0;
        foreach($data as $parent)
        {
            $displayOrder += 1;
            $deleted =  $parent->{'deleted'};
            $new = $parent->{'new'};
            $name = $parent->{'name'};
            $id = $parent->{'id'};
            $parent_id = null;
            $parent_id2 = $this->razRabotach($id, $name, $new, $deleted, $parent_id, $displayOrder);
            if (array_key_exists('children', $parent)) 
            {
                foreach($parent->{'children'} as $child)
                {
                    $displayOrder += 1;
                    $deleted =  $child->{'deleted'};
                    $new = $child->{'new'};
                    $name = $child->{'name'};
                    $id2 = $child->{'id'};
                    $parent_id3 = $this->razRabotach($id2, $name, $new, $deleted, $parent_id2, $displayOrder);
                    if (array_key_exists('children', $child))
                    { 
                        foreach($child->{'children'} as $grandchild)
                        {
                            $displayOrder += 1;
                            $deleted =  $grandchild->{'deleted'};
                            $new = $grandchild->{'new'};
                            $name = $grandchild->{'name'};
                            $id3 = $grandchild->{'id'};
                            $this->razRabotach($id3, $name, $new, $deleted, $parent_id3, $displayOrder);
                        }
                    }
                }
            }
        }

        return redirect()->route('category.index')->with('success','Category(s) Saved Successfully.');
    }

    public function edit(Category $category)
    {
        dd('adsf');
        return view('admin.category.edit', ['category' => $category, 'active' => $this->active]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validateRequest($request);
        
        $image = $request->file('banner');
        if($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/banners/category', $filename);
        } else {
            $filename = $category->banner;
        }

        $category->update([
            'category' => $request->category,
            'slug' => str_slug($request->category),
            'banner' => $filename,
            'description' => $request->description
        ]);
  
        return redirect()->route('category.index')
                        ->with('success','Category updated successfully');
    }


    private function validateRequest(Request $request) {
        return $request->validate([
            'category' => 'required|max:50'
        ]);
    }

    private function razRabotach($id, $name, $new, $deleted, $parent_id, $display_order)
    {   
        $category = new Category;
        
        if($deleted == 1 and $new == 1)
        {
            //do nothing
            return 9840528869;
        }
        elseif($deleted == 1 and $new == 0)
        {   
            $category = Category::find($id);
            $category->delete();
            return $id;
        }
        else
        {
            // if($new == 1) {
            //     $id = explode("-",$id)[1];
            // }
            $category = Category::updateOrCreate(
                ['id' => $id],
                [
                    'category' => $name,
                    'slug' => str_slug($name), 
                    'parent_id' => $parent_id,
                    'display_order' => $display_order
                ]
            );
            return $category->id;
        }
    }

}
