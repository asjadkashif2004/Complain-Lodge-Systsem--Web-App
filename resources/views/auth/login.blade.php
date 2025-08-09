<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 1rem;
    }
    .container-card {
      background: #fff;
      padding: 2.5rem 2rem 3rem;
      border-radius: 0.75rem;
      box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.15);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }
    .logo {
      margin-bottom: 2rem;
      max-height: 70px;
      max-width: 150px;
      object-fit: contain;
      filter: drop-shadow(0 0 1px rgba(0,0,0,0.1));
    }
    form {
      text-align: left;
    }
    .form-label {
      font-weight: 600;
      color: #333;
      font-size: 1rem;
    }
    .btn-primary {
      width: 100%;
      font-weight: 600;
      font-size: 1.05rem;
      padding: 0.5rem 0;
      border-radius: 0.5rem;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #2c7be5;
    }
    .login-footer {
      font-size: 0.9rem;
      margin-top: 1rem;
    }
    .login-footer a {
      color: #555;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s ease;
    }
    .login-footer a:hover {
      color: #0d6efd;
      text-decoration: underline;
    }
    .form-check-label {
      font-weight: 500;
      user-select: none;
    }
    .invalid-feedback {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>

  <div class="container-card shadow-sm">
    <img 
      src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png" 
      alt="Logo" 
      class="logo mx-auto d-block"
      loading="lazy"
    />

    @if(session('status'))
      <div class="alert alert-success text-center">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="current-password" />
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Remember Me -->
      <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }} />
        <label class="form-check-label" for="remember_me">Remember me</label>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-primary mb-3">Log in</button>

      <!-- Footer Links -->
      <div class="d-flex justify-content-between login-footer">
        <a href="{{ route('register') }}">Register</a>
        @if(Route::has('password.request'))
       @endif
      </div>
    </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
