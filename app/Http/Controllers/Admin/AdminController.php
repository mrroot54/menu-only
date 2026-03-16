<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\User; // User Model Import

class AdminController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle an admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Display the admin dashboard homepage.
     */
    public function dashboard()
    {
        // 1. Menu Items Count
        $totalItems = MenuItem::count();
        
        // 2. Categories Count
        $totalCategories = Category::count();
        
        // 3. Specials Count
        $totalSpecials = MenuItem::where('is_special', true)->count();
        
        // 4. Users Count
        $totalUsers = User::count();

        // Highlights
        $topSelling = MenuItem::where('is_top_selling', true)->count();
        $recommended = MenuItem::where('is_recommended', true)->count();
        
        // Recent Items (Abhi ke liye rakha hua, view mein use nahi ho raha)
        $recentItems = MenuItem::latest()->take(3)->get();

        // All Data passing to view
        return view('admin.dashboard', compact(
            'totalItems', 
            'totalCategories', 
            'totalSpecials',
            'totalUsers',
            'topSelling', 
            'recommended', 
            'recentItems'
        ));
    }

    /**
     * Display the list of categories.
     */
    public function categories()
    {
        $categories = Category::withCount('menuItems')
                        ->orderBy('order', 'ASC')
                        ->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Delete a specific category.
     */
    public function destroyCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('error', 'Category not found.');
        }

        // Check: Agar category mein items hain toh delete nahi kar sakte
        if ($category->menuItems()->count() > 0) {
            return back()->with('error', 'Cannot delete category. It has menu items inside.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }

    /**
     * Display the list of menu items.
     */
    public function menuItems()
    {
        $items = MenuItem::with('category')->latest()->get();
        return view('admin.menu-items.index', compact('items'));
    }
}