<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login | Green Leaf Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dashboard/css/styles.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  
  <style>
    body { background: #F1F5F9; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
    .login-container { background: white; padding: 40px 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); width: 100%; max-width: 400px; }
    .login-header { text-align: center; margin-bottom: 40px; }
    .login-logo { font-size: 40px; margin-bottom: 10px; }
    .login-title { font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: #1E293B; }
    .login-subtitle { color: #64748B; font-size: 14px; margin-top: 5px; }
    .form-group { margin-bottom: 20px; }
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
      <div class="alert alert-danger">{{ session('error') }}</div>
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

      <button type="submit" class="btn btn-primary btn-full btn-lg">Login to Dashboard</button>
    </form>
  </div>

  <script>
    gsap.fromTo('.login-container', { opacity: 0, y: 30, scale: 0.95 }, { opacity: 1, y: 0, scale: 1, duration: 0.6, ease: 'power3.out' });
  </script>
</body>
</html>