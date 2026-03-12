<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. List All Categories (With Icon Logic)
    public function index()
    {
        $categories = Category::orderBy('order', 'ASC')->get();

        // 👇 ICON MAPPING LOGIC START
        $data = $categories->map(function($cat) {
            // Default icon
            $icon = '🍽️'; 

            // Aapke Database names ke hisab se match karo
            if ($cat->name == 'Starters') {
                $icon = '🍢';
            } elseif ($cat->name == 'Main Course') {
                $icon = '🍝';
            } elseif ($cat->name == 'Drinks') {
                $icon = '🥤';
            } elseif ($cat->name == 'Desserts') {
                $icon = '🍰';
            }

            return [
                'id'    => $cat->id,
                'name'  => $cat->name,
                'order' => $cat->order,
                'icon'  => $icon // Yeh field frontend ke liye zaroori hai
            ];
        });
        // 👆 ICON MAPPING LOGIC END

        return response()->json([
            'success' => true,
            'data' => $data // Ab yahan modified $data variable bhej rahe hain
        ]);
    }

    // 2. Store New Category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories',
            'order' => 'nullable|integer'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'order' => $request->order ?? 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    // 3. Show Single Category
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    // 4. Update Category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|string|unique:categories,name,' . $category->id,
            'order' => 'sometimes|integer'
        ]);

        $category->update($request->only(['name', 'order']));

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    // 5. Delete Category
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}