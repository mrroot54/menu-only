@extends('layouts.admin')

@section('title', 'Menu Items')

@section('nav-menu', 'active')

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
          <h1 class="header-title">Menu Items</h1>
          <p class="header-subtitle">Manage your menu</p>
        </div>
      </div>
      <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary btn-sm">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        Add Item
      </a>
    </div>
  </header>
@endsection

@section('content')
    <style>
        .filter-container { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
        .filter-btn { padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1px solid #E5E7EB; background: white; color: #475569; cursor: pointer; transition: all 0.2s; }
        .filter-btn:hover { border-color: #14B8A6; color: #14B8A6; }
        .filter-btn.active { background: #14B8A6; color: white; border-color: #14B8A6; }
        .sno-badge-sm { width: 24px; height: 24px; background: #F1F5F9; color: #64748B; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-right: 12px; }
    </style>

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 16px; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="search-box" style="margin-bottom: 12px;">
      <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
      </svg>
      <input type="text" class="search-input" placeholder="Search items..." id="searchInput">
    </div>

    <div class="filter-container" id="filterContainer">
        <button class="filter-btn active" data-filter="all">All</button>
        @foreach($categories as $cat)
            <button class="filter-btn" data-filter="{{ $cat->id }}">{{ $cat->name }}</button>
        @endforeach
    </div>

    <div class="list" id="menu-list">
      @forelse($items as $item)
        <div class="list-item" data-id="{{ $item->id }}" data-name="{{ strtolower($item->name) }}" data-category="{{ $item->category_id }}">
          <div class="sno-badge-sm">{{ $loop->iteration }}</div>

          @if($item->image)
            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="list-item-image" style="width: 48px; height: 48px; border-radius: 8px; object-fit: cover; margin-right: 12px;">
          @else
            <div class="list-item-image" style="width: 48px; height: 48px; border-radius: 8px; background: #F1F5F9; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.75"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/></svg>
            </div>
          @endif

          <div class="list-item-content" style="flex: 1;">
            <div class="list-item-title">{{ $item->name }}</div>
            <div class="list-item-subtitle">{{ $item->category->name ?? 'Uncategorized' }} • ₹{{ $item->price }}</div>
            <div style="display: flex; gap: 4px; margin-top: 4px;">
                @if($item->is_special)
                    <span style="font-size:10px; background:#FEF3C7; color:#D97706; padding:2px 6px; border-radius:4px;">Special</span>
                @endif
                @if($item->is_top_selling)
                    <span style="font-size:10px; background:#DCFCE7; color:#16A34A; padding:2px 6px; border-radius:4px;">Top</span>
                @endif
                @if($item->is_recommended)
                    <!-- Changed "Pick" to "Recommended" -->
                    <span style="font-size:10px; background:#E0E7FF; color:#4F46E5; padding:2px 6px; border-radius:4px;">Recommended</span>
                @endif
            </div>
          </div>

          <div class="list-item-actions">
            <a href="{{ route('admin.menu-items.edit', $item->id) }}" class="btn btn-ghost btn-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
            </a>
            <form action="{{ route('admin.menu-items.destroy', $item->id) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-ghost btn-icon text-red-500" onclick="return confirm('Delete {{ $item->name }}?')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="text-center text-muted py-10">No menu items found.</div>
      @endforelse
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('input', function(e) { applyFilters(); });

    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            applyFilters();
        });
    });

    function applyFilters() {
        const searchText = document.getElementById('searchInput').value.toLowerCase();
        const activeBtn = document.querySelector('.filter-btn.active');
        const categoryFilter = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';

        const items = document.querySelectorAll('.list-item');
        let sno = 1; 

        items.forEach(item => {
            const itemName = item.getAttribute('data-name');
            const itemCat = item.getAttribute('data-category');

            const matchesSearch = itemName.includes(searchText);
            const matchesCategory = (categoryFilter === 'all') || (itemCat === categoryFilter);

            if(matchesSearch && matchesCategory) {
                item.style.display = 'flex';
                const snoBadge = item.querySelector('.sno-badge-sm');
                if(snoBadge) { snoBadge.innerText = sno; }
                sno++;
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endpush