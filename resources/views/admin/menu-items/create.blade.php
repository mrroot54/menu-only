@extends('layouts.admin')

@section('title', 'New Menu Item')

@section('nav-menu', 'active')

@section('header')
  <!-- Custom Header for Create Page -->
  <header class="header">
    <div class="header-content">
      <div class="header-left">
        <a href="{{ route('admin.menu-items.index') }}" class="back-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <div>
          <h1 class="header-title">New Item</h1>
          <p class="header-subtitle">Add a new menu item</p>
        </div>
      </div>
    </div>
  </header>
@endsection

@section('content')
  <main class="container page">
    <!-- Form Start -->
    <form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Image Upload Card -->
      <div class="card mb-4">
        <div class="card-body">
          <label class="form-label">Item Image</label>
          <div class="image-upload">
            <svg class="image-upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
              <circle cx="9" cy="9" r="2"/>
              <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
            </svg>
            <span class="image-upload-text">Tap to upload image</span>
            <input type="file" name="image" accept="image/*">
          </div>
        </div>
      </div>

      <!-- Basic Information Card -->
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">Basic Information</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-label" for="name">Item Name *</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              class="form-input" 
              placeholder="e.g., Garden Fresh Salad"
              value="{{ old('name') }}"
              required
            >
          </div>
          
          <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea 
              id="description" 
              name="description" 
              class="form-input form-textarea" 
              placeholder="Describe this menu item..."
              rows="3"
            >{{ old('description') }}</textarea>
          </div>
          
          <div class="form-group">
            <label class="form-label" for="price">Price (₹) *</label>
            <div class="price-input-wrapper">
              <span class="currency">₹</span>
              <input 
                type="number" 
                id="price" 
                name="price" 
                class="form-input" 
                placeholder="0.00"
                step="0.01"
                min="0"
                value="{{ old('price') }}"
                required
              >
            </div>
          </div>
          
          <div class="form-group">
            <label class="form-label" for="category_id">Category *</label>
            <select id="category_id" name="category_id" class="form-input form-select" required>
              <option value="">Select a category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <!-- Menu Highlights (Flags) Card -->
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">Menu Highlights</h3>
          <p class="card-description">Mark special attributes for this item</p>
        </div>
        <div class="card-body">
          <div class="flex flex-col gap-4">
            
            <!-- Top Selling -->
            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">Top Selling</div>
                <div class="text-muted" style="font-size: 0.8125rem;">Show as a popular item</div>
              </div>
              <!-- Laravel Friendly Switch -->
              <label class="switch">
                <input type="checkbox" name="is_top_selling" value="1" {{ old('is_top_selling') ? 'checked' : '' }}>
                <div class="switch-thumb"></div>
              </label>
            </div>
            
            <!-- Special -->
            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">Special</div>
                <div class="text-muted" style="font-size: 0.8125rem;">Today's special or limited offer</div>
              </div>
              <label class="switch">
                <input type="checkbox" name="is_special" value="1" {{ old('is_special') ? 'checked' : '' }}>
                <div class="switch-thumb"></div>
              </label>
            </div>
            
            <!-- Recommended -->
            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">Recommended</div>
                <div class="text-muted" style="font-size: 0.8125rem;">Chef's recommendation</div>
              </div>
              <label class="switch">
                <input type="checkbox" name="is_recommended" value="1" {{ old('is_recommended') ? 'checked' : '' }}>
                <div class="switch-thumb"></div>
              </label>
            </div>

          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary btn-full btn-lg">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        Create Item
      </button>
    </form>
  </main>
@endsection

@push('scripts')
<script>
    // Small script to handle switch toggle visually (if not handled by CSS)
    document.querySelectorAll('.switch input').forEach(input => {
        input.addEventListener('change', function() {
            if(this.checked) {
                this.parentElement.classList.add('active');
            } else {
                this.parentElement.classList.remove('active');
            }
        });
        // Initial state check
        if(input.checked) input.parentElement.classList.add('active');
    });
</script>
@endpush