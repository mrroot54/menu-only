<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\MenuItem;

class AdminController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        // Agar user pehle se logged in hai, toh use dashboard pe bhej do
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

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Login successful, redirect to dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // Login failed, redirect back with error
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
        // Database se Real Data fetch kar rahe hain
        $totalItems = MenuItem::count();
        $totalCategories = Category::count();
        $totalSpecials = MenuItem::where('is_special', true)->count();
        $topSelling = MenuItem::where('is_top_selling', true)->count();
        $recommended = MenuItem::where('is_recommended', true)->count();
        
        // Recent 3 items le rahe hain
        $recentItems = MenuItem::latest()->take(3)->get();

        // Data ko view mein bhej rahe hain
        return view('admin.dashboard', compact(
            'totalItems', 
            'totalCategories', 
            'totalSpecials', 
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
        // Categories ko unke items count ke saath fetch karein
        $categories = Category::withCount('menuItems')
                        ->orderBy('order', 'ASC')
                        ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Display the list of menu items.
     */
    public function menuItems()
    {
        // Menu items with category data
        $items = MenuItem::with('category')
                    ->latest()
                    ->get();

        return view('admin.menu-items.index', compact('items'));
    }
}