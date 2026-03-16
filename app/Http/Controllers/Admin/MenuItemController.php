<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // CHANGE: orderBy('id', 'ASC') lagaya hai taaki items 1, 2, 3... order mein aaye (MySQL jaisa)
        $items = MenuItem::with('category')->orderBy('id', 'ASC')->get();
        
        // Fetch Categories for Filter Buttons
        $categories = Category::orderBy('order', 'ASC')->get();

        return view('admin.menu-items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.menu-items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu'), $filename);
            $data['image'] = 'uploads/menu/' . $filename;
        }

        // Handle Boolean Flags (Checkboxes)
        $data['is_top_selling'] = $request->has('is_top_selling');
        $data['is_special'] = $request->has('is_special');
        $data['is_recommended'] = $request->has('is_recommended');

        MenuItem::create($data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu Item created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = MenuItem::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.menu-items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = MenuItem::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu'), $filename);
            $data['image'] = 'uploads/menu/' . $filename;
        }

        // Handle Boolean Flags
        $data['is_top_selling'] = $request->has('is_top_selling');
        $data['is_special'] = $request->has('is_special');
        $data['is_recommended'] = $request->has('is_recommended');

        $item->update($data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = MenuItem::findOrFail($id);

        // Delete image file
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        $item->delete();

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu Item deleted successfully!');
    }
}