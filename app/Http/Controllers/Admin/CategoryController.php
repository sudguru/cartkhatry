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

    public function create()
    {
        return view('admin.category.add', ['active' => $this->active]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $display_order = Category::count() + 1;
        Category::create([
            'payment_method' => $request->payment_method,
            'slug' => str_slug($request->payment_method),
            'display_order' => $display_order
        ]);
        return redirect()->route('category.index')->with('success','Category Added Successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category, 'active' => $this->active]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validateRequest($request);
        $category->update([
            'payment_method' => $request->payment_method,
            'slug' => str_slug($request->payment_method)
        ]);
  
        return redirect()->route('category.index')
                        ->with('success','Category updated successfully');
    }

    public function show()
    {
        //
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'payment_method' => 'required|max:50'
        ]);
    }

    public function sortit(Request $request) {
        $order = $request->order;
        foreach ($order as $key => $value) {
            $p = Category::find($value);
            $p->display_order = $key + 1;
            $p->save();
        }
        return response()->json('ok', 200);
    }
}
