@extends('layouts.admin')

@section('title', 'Categories')

@section('nav-cat', 'active')

@section('header')
  <header class="header">
    <div class="header-content">
      <div class="header-left">
        <a href="{{ route('admin.dashboard') }}" class="back-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <div>
          <h1 class="header-title">Categories</h1>
          <p class="header-subtitle">Manage menu categories</p>
        </div>
      </div>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        Add
      </a>
    </div>
  </header>
@endsection

@section('content')
    <!-- Custom Style for Small SNo Badge -->
    <style>
        .sno-badge {
            width: 24px;       /* Reduced from 32px */
            height: 24px;      /* Reduced from 32px */
            background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);
            color: white;
            border-radius: 6px; /* Reduced from 10px */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;   /* Reduced from 14px */
            font-weight: 700;
            flex-shrink: 0;
            margin-right: 12px;
            box-shadow: 0 1px 3px rgba(20, 184, 166, 0.3);
        }
        
        .list-item {
            align-items: center; 
        }
    </style>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 16px; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 16px; font-size: 14px;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Box -->
    <div class="search-box">
      <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/>
        <path d="M21 21l-4.35-4.35"/>
      </svg>
      <input type="text" class="search-input" placeholder="Search categories..." id="searchInput">
    </div>

    <!-- Categories List -->
    <div class="list" id="categories-list">
      @forelse($categories as $cat)
        <div class="list-item" data-id="{{ $cat->id }}" data-name="{{ strtolower($cat->name) }}">
          
          <!-- Small SNo Badge -->
          <div class="sno-badge">
            {{ $loop->iteration }}
          </div>

          <div class="list-item-content">
            <div class="list-item-title">{{ $cat->name }}</div>
            <div class="list-item-subtitle">{{ $cat->menu_items_count ?? 0 }} items</div>
          </div>
          
          <div class="list-item-actions">
            <!-- Edit Button -->
            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-ghost btn-icon" title="Edit">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
              </svg>
            </a>
            <!-- Delete Form -->
            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-ghost btn-icon text-red-500" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $cat->name }}?')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="text-center text-muted py-10">No categories found.</div>
      @endforelse
    </div>
@endsection

@push('scripts')
<script>
    // Simple Search Logic
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.list-item');
        
        items.forEach(item => {
            const name = item.getAttribute('data-name');
            if(name.includes(query)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush