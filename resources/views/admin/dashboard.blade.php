@extends('layouts.admin')

@section('title', 'Dashboard')

@section('nav-home', 'active')

@section('header')
  <header class="header">
    <div class="header-content">
      <div class="header-info">
        <div class="brand-title">Green Leaf Kitchen</div>
        <p class="header-subtitle">Welcome, {{ Auth::user()->name }}</p>
      </div>
      <div class="profile-avatar">
         <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:inherit;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
         </a>
         <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
            @csrf
         </form>
      </div>
    </div>
  </header>
@endsection

@section('content')
    <!-- Stats Grid (4 Cards) -->
    <div class="stats-grid">
      
      <!-- 1. Menu Items -->
      <div class="stat-card primary">
        <div class="stat-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
          </svg>
        </div>
        <div class="stat-value">{{ $totalItems }}</div>
        <div class="stat-label">Menu Items</div>
      </div>
      
      <!-- 2. Categories -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
          </svg>
        </div>
        <div class="stat-value">{{ $totalCategories }}</div>
        <div class="stat-label">Categories</div>
      </div>

      <!-- 3. Specials -->
      <div class="stat-card">
        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
          </svg>
        </div>
        <div class="stat-value">{{ $totalSpecials }}</div>
        <div class="stat-label">Specials</div>
      </div>

      <!-- 4. Users -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <div class="stat-value">{{ $totalUsers }}</div>
        <div class="stat-label">Users</div>
      </div>

    </div>

    <!-- Quick Actions -->
    <section class="section">
      <div class="section-header">
        <h2 class="section-title">Quick Actions</h2>
      </div>
      <div class="quick-actions">
        <a href="#" class="quick-action">
          <svg class="quick-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M12 5v14M5 12h14"/>
          </svg>
          <span class="quick-action-label">Add Item</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="quick-action">
          <svg class="quick-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
            <path d="M12 11v6M9 14h6"/>
          </svg>
          <span class="quick-action-label">Category</span>
        </a>
        <a href="{{ route('admin.menu-items.index') }}" class="quick-action">
          <svg class="quick-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
          </svg>
          <span class="quick-action-label">Menu</span>
        </a>
      </div>
    </section>

    <!-- Highlights -->
    <section class="section">
      <div class="section-header">
        <h2 class="section-title">Highlights</h2>
      </div>
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/>
              <path d="m9 12 2 2 4-4"/>
            </svg>
          </div>
          <div class="stat-value">{{ $topSelling }}</div>
          <div class="stat-label">Top Selling</div>
        </div>
        
        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(99, 102, 241, 0.1); color: #6366F1;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2 2 7l10 5 10-5-10-5Z"/>
              <path d="m2 17 10 5 10-5"/>
              <path d="m2 12 10 5 10-5"/>
            </svg>
          </div>
          <div class="stat-value">{{ $recommended }}</div>
          <div class="stat-label">Recommended</div>
        </div>
      </div>
    </section>
    <!-- Recent Items Section Removed Here -->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if(typeof animateStatsCards === 'function') animateStatsCards();
        if(typeof animateQuickActions === 'function') animateQuickActions();
        if(typeof animateSections === 'function') animateSections();
    });
</script>
@endpush