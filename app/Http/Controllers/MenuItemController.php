<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sirf all items bhejenge, availability check nahi
        $items = MenuItem::with('category')->get();

        $data = $items->map(function($item) {
            $imageUrl = null;
            if ($item->image) {
                $imageUrl = str_starts_with($item->image, 'http') ? $item->image : asset($item->image);
            }

            return [
                'id'            => $item->id,
                'category_id'   => $item->category_id,
                'name'          => $item->name,
                'description'   => $item->description,
                'price'         => $item->price,
                'image_url'     => $imageUrl,
                'is_special'    => $item->is_special,        
                'is_recommended'=> $item->is_recommended,    
                'is_top_selling'=> $item->is_top_selling,     
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get Top Selling Items (Public).
     */
    public function topSelling()
    {
        // Availability check hat gayi
        $items = MenuItem::with('category')
                    ->where('is_top_selling', true)
                    ->get();

        $data = $items->map(function($item) {
            $imageUrl = null;
            if ($item->image) {
                $imageUrl = str_starts_with($item->image, 'http') ? $item->image : asset($item->image);
            }

            return [
                'id'            => $item->id,
                'name'          => $item->name,
                'price'         => $item->price,
                'image_url'     => $imageUrl,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Search Items (Public).
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a search query.'
            ], 400);
        }

        // Availability check hat gayi
        $items = MenuItem::with('category')
                    ->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

        $data = $items->map(function($item) {
            $imageUrl = null;
            if ($item->image) {
                $imageUrl = str_starts_with($item->image, 'http') ? $item->image : asset($item->image);
            }
            
            return [
                'id'            => $item->id,
                'category_id'   => $item->category_id,
                'name'          => $item->name,
                'description'   => $item->description,
                'price'         => $item->price,
                'image_url'     => $imageUrl,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // STORE, UPDATE, DESTROY functions same rahenge, bas validation se 'is_available' hata dena hai.

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'is_available' => 'boolean', // REMOVED
            'is_top_selling' => 'boolean',
            'is_special' => 'boolean',
            'is_recommended' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu'), $filename);
            $data['image'] = 'uploads/menu/' . $filename;
        }

        $item = MenuItem::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu Item created successfully',
            'data' => $item
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $item = MenuItem::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'is_available' => 'boolean', // REMOVED
            'is_top_selling' => 'boolean',
            'is_special' => 'boolean',
            'is_recommended' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu'), $filename);
            $data['image'] = 'uploads/menu/' . $filename;
        }

        $item->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu Item updated successfully',
            'data' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = MenuItem::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu Item deleted successfully'
        ]);
    }
}