@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('nav-menu', 'active')

@section('header')
  <header class="header">
    <div class="header-content">
      <div class="header-left">
        <a href="{{ route('admin.menu-items.index') }}" class="back-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <div>
          <h1 class="header-title">Edit Item</h1>
          <p class="header-subtitle">Update menu item details</p>
        </div>
      </div>
      
      <!-- Delete Button in Header -->
      <form action="{{ route('admin.menu-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-ghost btn-icon text-red-500">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
          </svg>
        </button>
      </form>

    </div>
  </header>
@endsection

@section('content')
  <main class="container page">
    <form action="{{ route('admin.menu-items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Image Upload -->
      <div class="card mb-4">
        <div class="card-body">
          <label class="form-label">Item Image</label>
          <div class="image-upload" id="image-upload">
            
            <!-- Show Existing Image or Placeholder -->
            @if($item->image)
              <img src="{{ asset($item->image) }}" class="image-upload-preview" alt="{{ $item->name }}">
            @else
              <svg class="image-upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <circle cx="9" cy="9" r="2"/>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
              </svg>
              <span class="image-upload-text">Tap to upload image</span>
            @endif

            <input type="file" name="image" accept="image/*">
          </div>
          <small class="text-muted">Upload new image to replace existing one.</small>
        </div>
      </div>

      <!-- Basic Info -->
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">Basic Information</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-label" for="name">Item Name *</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="e.g., Garden Fresh Salad" value="{{ old('name', $item->name) }}" required>
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
          </div>
          
          <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-input form-textarea" placeholder="Describe this menu item..." rows="3">{{ old('description', $item->description) }}</textarea>
          </div>
          
          <div class="form-group">
            <label class="form-label" for="price">Price (₹) *</label>
            <div class="price-input-wrapper">
              <span class="currency">₹</span>
              <input type="number" id="price" name="price" class="form-input" placeholder="0.00" step="0.01" min="0" value="{{ old('price', $item->price) }}" required>
            </div>
            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
          </div>
          
          <div class="form-group">
            <label class="form-label" for="category_id">Category *</label>
            <select id="category_id" name="category_id" class="form-input form-select" required>
              <option value="">Select a category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <!-- Flags -->
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
              <label class="switch">
                <input type="checkbox" name="is_top_selling" {{ $item->is_top_selling ? 'checked' : '' }}>
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
                <input type="checkbox" name="is_special" {{ $item->is_special ? 'checked' : '' }}>
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
                <input type="checkbox" name="is_recommended" {{ $item->is_recommended ? 'checked' : '' }}>
                <div class="switch-thumb"></div>
              </label>
            </div>

          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-full btn-lg">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
        Save Changes
      </button>
    </form>
  </main>
@endsection

@push('scripts')
<script>
    // Script to handle image preview on change
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const uploadDiv = document.getElementById('image-upload');
                // Remove existing content/icons
                uploadDiv.innerHTML = '';
                // Create and append image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'image-upload-preview';
                uploadDiv.appendChild(img);
                // Re-append the input
                uploadDiv.appendChild(e.target);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush