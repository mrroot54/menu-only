<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('menuItems')
                        ->orderBy('order', 'ASC')
                        ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic: Database mein sabse bada 'order' number dhundho
        $maxOrder = Category::max('order');
        
        // Agar koi category nahi hai to 1, agar hai to +1
        $nextOrder = $maxOrder ? $maxOrder + 1 : 1;

        // Is variable ko view par bhejo
        return view('admin.categories.create', compact('nextOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'order' => 'nullable|integer'
        ]);

        Category::create([
            'name' => $request->name,
            'order' => $request->order ?? 0
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
            'order' => 'nullable|integer'
        ]);

        $category->update([
            'name' => $request->name,
            'order' => $request->order ?? 0
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->menuItems()->count() > 0) {
            return back()->with('error', 'Cannot delete category. It has menu items inside.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}