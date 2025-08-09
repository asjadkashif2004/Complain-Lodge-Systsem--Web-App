<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
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
      border-radius: 0.5rem;
      box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
      width: 100%;
      max-width: 450px;
      text-align: center;
    }
    .logo-wrapper {
      background: #fff;
      padding: 10px 20px;
      border-radius: 0.75rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      display: inline-block;
      margin-bottom: 2rem;
    }
    .logo-wrapper img {
      max-height: 70px;
      max-width: 160px;
      object-fit: contain;
      display: block;
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
    .footer-text {
      font-size: 0.9rem;
      margin-top: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .footer-text span {
      font-weight: 500;
      color: #555;
    }
    .footer-text a {
      font-weight: 500;
      color: #0d6efd;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .footer-text a:hover {
      color: #0a58ca;
      text-decoration: underline;
    }
    .invalid-feedback {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>

  <div class="container-card shadow-sm">
    <div class="logo-wrapper mx-auto">
      <img 
        src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png" 
        alt="Logo"
          class="logo mx-auto d-block"
    
        loading="lazy"
      />
    </div>

    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text"
               class="form-control @error('name') is-invalid @enderror"
               name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="username">
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="new-password">
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-4">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password"
               class="form-control @error('password_confirmation') is-invalid @enderror"
               name="password_confirmation" required autocomplete="new-password">
        @error('password_confirmation')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary mb-3">Register</button>

      <div class="footer-text">
        <span>Already registered?</span>
        <a href="{{ route('login') }}">Log in</a>
      </div>
    </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
