<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login | Green Leaf Admin</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  
  <!-- FIX: Path changed from 'dashboard/css/...' to 'css/...' -->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  
  <style>
    /* Basic Reset & Page Centering */
    body { 
        background: #F1F5F9; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        min-height: 100vh; 
        margin: 0;
        font-family: 'Inter', sans-serif;
    }
    
    /* Card Styling */
    .login-container { 
        background: white; 
        padding: 40px 30px; 
        border-radius: 24px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        width: 100%; 
        max-width: 400px; 
    }
    
    /* Header Styling */
    .login-header { text-align: center; margin-bottom: 40px; }
    .login-logo { font-size: 40px; margin-bottom: 10px; }
    .login-title { font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: #1E293B; }
    .login-subtitle { color: #64748B; font-size: 14px; margin-top: 5px; }
    
    /* Form Styling */
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; margin-bottom: 8px; font-weight: 500; color: #334155; font-size: 14px; }
    .form-input { 
        width: 100%; 
        padding: 14px 16px; 
        border: 1px solid #E2E8F0; 
        border-radius: 12px; 
        font-size: 16px; 
        transition: all 0.2s;
        background: #F8FAFC;
    }
    .form-input:focus { 
        outline: none; 
        border-color: #14B8A6; 
        background: white; 
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }
    
    /* Button Styling */
    .btn-primary { 
        width: 100%; 
        padding: 16px; 
        background: #14B8A6; 
        color: white; 
        border: none; 
        border-radius: 12px; 
        font-size: 16px; 
        font-weight: 600; 
        cursor: pointer; 
        transition: background 0.2s;
    }
    .btn-primary:hover { background: #0D9488; }
    
    /* Error Box */
    .alert-danger {
        background: #FEF2F2;
        color: #B91C1C;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 14px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-header">
      <div class="login-logo">🌿</div>
      <div class="login-title">Green Leaf</div>
      <div class="login-subtitle">Admin Dashboard</div>
    </div>

    @if(session('error'))
      <div class="alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      
      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-input" placeholder="admin@admin.com" required autofocus>
      </div>
      
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="Enter password" required>
      </div>

      <button type="submit" class="btn-primary">Login to Dashboard</button>
    </form>
  </div>

  <script>
    gsap.fromTo('.login-container', { opacity: 0, y: 30, scale: 0.95 }, { opacity: 1, y: 0, scale: 1, duration: 0.6, ease: 'power3.out' });
  </script>
</body>
</html>