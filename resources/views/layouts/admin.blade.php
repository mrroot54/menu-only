<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="theme-color" content="#14B8A6">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Green Leaf Kitchen</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('dashboard/css/styles.css') }}">
  
  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
</head>
<body>
  
  <!-- Header Section -->
  @section('header')
  <header class="header">
    <div class="header-content">
      <div class="header-info">
        <div class="brand-title">Green Leaf Kitchen</div>
        <p class="header-subtitle">Admin Dashboard</p>
      </div>
      <div class="profile-avatar">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
      </div>
    </div>
  </header>
  @show

  <!-- Main Content Area -->
  <main class="container page">
    @yield('content')
  </main>

  <!-- Bottom Navigation -->
  <nav class="bottom-nav">
    <ul class="nav-list">
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link @yield('nav-home')">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.categories.index') }}" class="nav-link @yield('nav-cat')">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
          </svg>
          <span>Categories</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.menu-items.index') }}" class="nav-link @yield('nav-menu')">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
          </svg>
          <span>Menu</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
          <span>Users</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Toast Container -->
  <div class="toast-container"></div>

  <!-- Main JS -->
  <script src="{{ asset('dashboard/js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>