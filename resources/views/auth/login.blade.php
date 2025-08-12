<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      /* Brand palette */
      --bg-start:#0f172a;   /* slate-900 */
      --bg-end:#111827;     /* gray-900 */
      --text:#e5e7eb;       /* gray-200 */
      --muted:#9ca3af;      /* gray-400 */
      --violet:#7c3aed;     /* violet-600 */
      --blue:#5b8cff;       /* blue-violet */

      --glass-bg: rgba(255,255,255,.06);
      --glass-brd: rgba(255,255,255,.12);
      --field-brd: rgba(255,255,255,.18);
      --focus-ring: rgba(124,58,237,.22);

      --logo-h:64px;        /* adjust to resize logo */
      --radius:18px;
    }

    html,body{height:100%}
    body{
      margin:0;padding:clamp(16px,2vw,32px);
      color:var(--text);
      font-family:'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
      background:
        radial-gradient(55rem 55rem at 10% -20%, rgba(124,58,237,.22), transparent 60%),
        radial-gradient(50rem 50rem at 110% 0%, rgba(34,211,238,.16), transparent 60%),
        linear-gradient(180deg,var(--bg-start),var(--bg-end));
      display:grid;place-items:center;
    }

    /* Subtle grid mask */
    body::before{
      content:"";position:fixed;inset:0;pointer-events:none;z-index:0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size:22px 22px;
      mask-image:radial-gradient(ellipse at center, black 45%, transparent 72%);
    }

    .auth-wrap{position:relative;z-index:1;width:100%;max-width:460px}

    /* Refined glass card */
    .card-pro{
      background:var(--glass-bg);
      border:1px solid var(--glass-brd);
      border-radius:var(--radius);
      padding:28px 24px 26px;
      backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
      box-shadow:0 18px 50px rgba(0,0,0,.48), inset 0 1px 0 rgba(255,255,255,.04);
      transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }
    .card-pro:hover{transform:translateY(-1px);box-shadow:0 22px 56px rgba(0,0,0,.55)}

    /* Minimal gradient hairline around the card */
    .card-pro::before{
      content:""; position:absolute; inset:-1px; border-radius:calc(var(--radius) + 1px);
      padding:1px;
      background:linear-gradient(135deg, rgba(91,140,255,.55), rgba(124,58,237,.45));
      -webkit-mask:linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
      -webkit-mask-composite:xor; mask-composite:exclude;
      opacity:.35; pointer-events:none;
    }

    /* Brand / logo */
    .brand{display:grid;place-items:center;gap:10px;margin-bottom:12px}
    .brand img{
      height:var(--logo-h);width:auto;display:block;border-radius:12px;
      background:linear-gradient(135deg, rgba(91,140,255,.18), rgba(124,58,237,.18));
      padding:6px;
      box-shadow:0 10px 26px rgba(91,140,255,.22);
    }

    .headline{text-align:center;margin-bottom:16px}
    .headline h1{
      margin:0 0 6px;
      font-family:'Plus Jakarta Sans','Inter',system-ui,sans-serif;
      font-weight:700; letter-spacing:.2px;
      font-size:clamp(22px,2.2vw,26px);
    }
    .headline p{margin:0;color:var(--muted);font-size:14px}

    /* Form */
    .form-label{color:var(--text);font-weight:600;font-size:.95rem}
    .form-control{
      color:var(--text);
      background:rgba(255,255,255,.06);
      border:1px solid var(--field-brd);
      border-radius:12px; padding:12px 44px 12px 14px;
      transition:border-color .2s ease, box-shadow .2s ease, background-color .2s ease, transform .1s ease;
    }
    .form-control:focus{
      color:var(--text);
      background:rgba(255,255,255,.08);
      border-color:rgba(124,58,237,.6);
      box-shadow:0 0 0 4px var(--focus-ring);
      transform:translateY(-1px);
    }
    .input-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);opacity:.72}
    .invalid-feedback{color:#fecaca}

    /* Buttons */
    .btn-primary{
      --bs-btn-color:#0b1020;
      --bs-btn-bg:transparent; --bs-btn-border-color:transparent;
      position:relative; overflow:hidden; border-radius:14px; border:none;
      font-weight:800; letter-spacing:.2px; padding:12px 16px;
      background-image:linear-gradient(120deg, var(--violet), var(--blue));
      box-shadow:0 10px 24px rgba(91,140,255,.3), 0 0 0 1px rgba(255,255,255,.06) inset;
      transition:transform .15s ease, box-shadow .25s ease, filter .2s ease, background-position .35s ease;
      background-size:160% 160%;
      background-position:0% 50%;
    }
    .btn-primary:hover{
      transform:translateY(-2px);
      box-shadow:0 14px 30px rgba(91,140,255,.45), 0 0 0 1px rgba(255,255,255,.1) inset;
      filter:brightness(1.04);
      background-position:100% 50%;
    }
    .btn-primary:active{transform:translateY(0)}

    .btn-ghost{
      color:#e6ebff; border:1px solid transparent; border-radius:14px;
      font-weight:800; padding:10px 14px; position:relative; background:transparent;
      transition:transform .15s ease, box-shadow .25s ease, background-color .25s ease;
    }
    .btn-ghost::before{
      content:""; position:absolute; inset:0; border-radius:14px; padding:1px;
      background:linear-gradient(120deg, rgba(91,140,255,.75), rgba(124,58,237,.75));
      -webkit-mask:linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
      -webkit-mask-composite:xor; mask-composite:exclude;
      opacity:.8; transition:opacity .25s ease;
    }
    .btn-ghost:hover{
      background:linear-gradient(120deg, rgba(91,140,255,.14), rgba(124,58,237,.14));
      transform:translateY(-1px);
      box-shadow:0 8px 22px rgba(124,58,237,.25);
    }

    /* Divider */
    .divider{display:flex;align-items:center;gap:.75rem;margin:14px 0}
    .divider hr{flex:1;border-color:rgba(255,255,255,.14);opacity:1}
    .divider span{color:var(--muted);font-size:.9rem}

    /* Reduce motion */
    @media (prefers-reduced-motion:reduce){
      .btn-primary,.card-pro{transition:none}
    }
  </style>
</head>
<body>

  <div class="auth-wrap">
    <div class="card-pro position-relative">
      <!-- Brand -->
      <div class="brand">
        <img
          src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png"
          alt="CMS Logo"
          loading="lazy"
          decoding="async"
          style="height:var(--logo-h)"
        />
      </div>

      <!-- Headline -->
      <div class="headline">
        <h1>Welcome back</h1>
        <p>Please sign in to continue</p>
      </div>

      @if(session('status'))
        <div class="alert alert-success text-center py-2 mb-3" role="status" aria-live="polite">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Email -->
        <div class="mb-3 position-relative">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email"
                 class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
          <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 7l9 6 9-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/>
          </svg>
          @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Password -->
        <div class="mb-2 position-relative">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="current-password" />
          <button type="button" class="position-absolute p-0 border-0 bg-transparent"
                  style="right:8px;top:50%;transform:translateY(-50%);color:var(--muted)"
                  aria-label="Toggle password visibility" onclick="togglePassword()" title="Show/Hide password">
            <svg id="eyeIcon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>
            </svg>
          </button>
          @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Remember & Forgot -->
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }} />
            <label class="form-check-label" for="remember_me">Remember me</label>
          </div>
          <div>
          </div>
        </div>

        <!--Back to home button-->
        <div class="d-grid gap-2 mb-3"> 
          <a href="{{ url('/') }}" class="btn btn-ghost position-relative">
            <i class="bi bi-house-door me-1"></i> Back to home
          </a>
        </div>

        <!-- Sign in -->
        <button type="submit" class="btn btn-primary w-100 mt-2">Sign in</button>

        <!-- Divider -->
        <div class="divider">
          <hr><span>or</span><hr>
        </div>

        <!-- Create account (prominent, clean) -->
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="btn btn-ghost w-100">Create a new account</a>
        @endif
      </form>
    </div>
  </div>

  <script>
    function togglePassword(){
      const input = document.getElementById('password');
      const icon = document.getElementById('eyeIcon');
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      icon.innerHTML = isPassword
        ? '<path d="M3 3l18 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />\
           <path d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />\
           <path d="M9.88 5.09A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.84 17.84 0 01-4.32 4.94" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />\
           <path d="M6.1 6.1A17.81 17.81 0 002 12s3.5 7 10 7a10.6 10.6 0 005.9-1.9" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />'
        : '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>';
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
