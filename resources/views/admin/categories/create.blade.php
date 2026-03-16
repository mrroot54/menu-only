@extends('layouts.admin')

@section('title', 'New Category')

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
          <h1 class="header-title">New Category</h1>
          <p class="header-subtitle">Add a new menu category</p>
        </div>
      </div>
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

        <form action="{{ route('admin.categories.store') }}" method="POST">
          @csrf
          
          <div class="form-group">
            <label class="form-label" for="name">Category Name *</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              class="form-input" 
              placeholder="e.g., Main Course"
              value="{{ old('name') }}"
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
              value="{{ old('order', $nextOrder) }}" 
            >
            <p class="text-muted mt-1" style="font-size: 0.8125rem;">Categories are displayed in ascending order.</p>
          </div>
          
          <button type="submit" class="btn btn-primary btn-full btn-lg mt-4">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Create Category
          </button>
        </form>
      </div>
    </div>
@endsection