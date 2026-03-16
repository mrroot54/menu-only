@extends('layouts.admin')

@section('title', 'Edit Category')

@section('nav-cat', 'active')

@section('header')
  <header class="header">
    <div class="header-content">
      <div class="header-left">
        <a href="{{ route('admin.categories.index') }}" class="back-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <div>
          <h1 class="header-title">Edit Category</h1>
          <p class="header-subtitle">Update category details</p>
        </div>
      </div>
      
      <!-- Delete Button Header -->
      <button class="btn btn-ghost btn-icon text-danger" onclick="document.getElementById('delete-form').submit();">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
        </svg>
      </button>
      <!-- Hidden Delete Form -->
      <form id="delete-form" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
          @csrf
          @method('DELETE')
      </form>

    </div>
  </header>
@endsection

@section('content')
    <div class="card">
      <div class="card-body">
        
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="form-group">
            <label class="form-label" for="name">Category Name *</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              class="form-input" 
              placeholder="e.g., Main Course"
              value="{{ old('name', $category->name) }}"
              required
            >
          </div>
          
          <div class="form-group">
            <label class="form-label" for="order">Display Order</label>
            <input 
              type="number" 
              id="order" 
              name="order" 
              class="form-input" 
              placeholder="1"
              min="1"
              value="{{ old('order', $category->order) }}"
            >
            <p class="text-muted mt-1" style="font-size: 0.8125rem;">Categories are displayed in ascending order.</p>
          </div>
          
          <button type="submit" class="btn btn-primary btn-full btn-lg mt-4">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
            Save Changes
          </button>
        </form>
      </div>
    </div>
@endsection

@push('scripts')
<script>
    // Optional: Add a confirmation dialog on delete button click
    document.querySelector('.text-danger').addEventListener('click', function(e) {
        if(!confirm('Are you sure you want to delete this category?')) {
            e.preventDefault();
            e.stopImmediatePropagation();
        }
    });
</script>
@endpush