<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg-start:#0f172a; /* slate-900 */
      --bg-end:#111827;   /* gray-900 */
      --text-primary:#e5e7eb; /* gray-200 */
      --text-muted:#9ca3af;   /* gray-400 */
      --primary-1:#5b8cff;    /* blue-violet blend */
      --primary-2:#7c3aed;    /* violet-600 */
    }

    html,body{height:100%}
    body{
      margin:0; padding:clamp(16px,2vw,32px);
      font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
      color:var(--text-primary);
      background:
        radial-gradient(60rem 60rem at 10% -20%, rgba(124,58,237,0.25), transparent 60%),
        radial-gradient(50rem 50rem at 110% 0%, rgba(34,211,238,0.20), transparent 60%),
        linear-gradient(180deg, var(--bg-start), var(--bg-end));
      display:grid; place-items:center;
    }

    body::before{content:"";position:fixed;inset:0;background-image:linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);background-size:24px 24px;mask-image:radial-gradient(ellipse at center, black 40%, transparent 70%);pointer-events:none;z-index:0}

    .auth-wrap{position:relative;z-index:1;width:100%;max-width:480px}
    .card-pro{
      background:rgba(255,255,255,0.06);
      border:1px solid rgba(255,255,255,0.12);
      border-radius:18px; padding:28px 26px 30px;
      box-shadow:0 20px 50px rgba(0,0,0,.45), inset 0 1px 0 rgba(255,255,255,.04);
      backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px);
      transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .card-pro:hover{transform:translateY(-2px);box-shadow:0 28px 60px rgba(0,0,0,.55);border-color:rgba(255,255,255,.18)}

    .brand{display:grid;place-items:center;gap:8px;margin-bottom:14px}
    .brand img{max-height:64px;max-width:160px;filter:drop-shadow(0 1px 6px rgba(0,0,0,.35))}

    .headline{text-align:center;margin-bottom:18px}
    .headline h1{font-size:clamp(20px,2.2vw,24px);margin:0 0 6px;font-weight:700;letter-spacing:.2px}
    .headline p{margin:0;color:var(--text-muted);font-size:14px}

    .form-label{color:var(--text-primary);font-weight:600;font-size:.95rem}
    .form-text{color:var(--text-muted)}

    .form-control{
      color:var(--text-primary);
      background:rgba(255,255,255,0.06);
      border:1px solid rgba(255,255,255,0.12);
      border-radius:12px; padding:12px 44px 12px 14px;
      transition:border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .form-control:focus{color:var(--text-primary);background:rgba(255,255,255,0.08);border-color:rgba(124,58,237,0.6);box-shadow:0 0 0 4px rgba(124,58,237,0.18)}

    .input-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);opacity:.7;transition:opacity .2s ease;pointer-events:none}
    .form-control:focus + .input-icon{opacity:1}

    .invalid-feedback{color:#fecaca}
    .alert-success{background:rgba(34,197,94,0.12);border-color:rgba(34,197,94,0.35);color:#d1fae5}

    .btn-primary{
      --bs-btn-bg:transparent; --bs-btn-border-color:transparent; --bs-btn-color:#0b1020;
      position:relative; overflow:hidden; border-radius:14px; font-weight:700; border:none;
      padding:12px 16px; letter-spacing:.2px;
      background-image:linear-gradient(90deg, var(--primary-2), var(--primary-1));
      box-shadow:0 10px 30px rgba(91,140,255,0.35);
      transition:transform .18s ease, box-shadow .25s ease, filter .2s ease;
    }
    .btn-primary:hover{transform:translateY(-1px);box-shadow:0 16px 36px rgba(91,140,255,0.5);filter:brightness(1.03)}
    .btn-primary:active{transform:translateY(0);box-shadow:0 8px 22px rgba(91,140,255,0.35)}
    .btn-primary::before{content:"";position:absolute;inset:0;background:linear-gradient(120deg,transparent,rgba(255,255,255,.35),transparent);transform:translateX(-120%);transition:transform .6s ease;pointer-events:none}
    .btn-primary:hover::before{transform:translateX(120%)}

    .btn-outline{background:transparent;border:1px solid rgba(255,255,255,0.16);color:var(--text-primary);border-radius:14px;font-weight:600;padding:10px 14px;transition:all .25s ease}
    .btn-outline:hover{background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.28)}

    .meta{display:flex;justify-content:space-between;gap:10px;align-items:center;margin-top:10px}
    .links a{color:var(--text-muted);text-decoration:none;font-weight:600}
    .links a:hover{color:#c7d2fe;text-decoration:underline}

    .reveal{position:absolute;right:8px;top:50%;transform:translateY(-50%);background:transparent;border:0;padding:6px;border-radius:8px;color:var(--text-muted);transition:background-color .2s ease,color .2s ease;cursor:pointer}
    .reveal:hover{background:rgba(255,255,255,0.08);color:var(--text-primary)}

    .progress{height:6px;border-radius:999px;background:rgba(255,255,255,0.08)}
    .progress-bar{background-image:linear-gradient(90deg, var(--primary-2), var(--primary-1))}

    @media (prefers-reduced-motion: reduce){ .btn-primary,.card-pro{transition:none} .btn-primary::before{display:none} }
  </style>
</head>
<body>
  <div class="auth-wrap">
    <div class="card-pro">
      <div class="brand">
        <img src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png" alt="Logo" loading="lazy" />
      </div>

      <div class="headline">
        <h1>Create your account</h1>
        <p>Join us in seconds. It’s fast and free.</p>
      </div>

      @if(session('status'))
        <div class="alert alert-success text-center py-2 mb-3">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div class="mb-3 position-relative">
          <label for="name" class="form-label">Name</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
          <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 12a5 5 0 100-10 5 5 0 000 10z" stroke="currentColor" stroke-width="1.6"/><path d="M3 22a9 9 0 0118 0" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
          @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <!-- Email -->
        <div class="mb-3 position-relative">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username" />
          <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7l9 6 9-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/></svg>
          @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-2 position-relative">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
          <button type="button" class="reveal" aria-label="Toggle password visibility" onclick="togglePassword('password','eyeIcon1')">
            <svg id="eyeIcon1" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>
            </svg>
          </button>
          @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <!-- Strength meter -->
        <div class="mb-3">
          <div class="progress" role="progressbar" aria-label="Password strength" aria-valuemin="0" aria-valuemax="100">
            <div id="strengthBar" class="progress-bar" style="width:0%"></div>
          </div>
          <small id="strengthText" class="form-text">Start typing to check password strength.</small>
        </div>

        <!-- Confirm Password -->
        <div class="mb-2 position-relative">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" />
          <button type="button" class="reveal" aria-label="Toggle password visibility" onclick="togglePassword('password_confirmation','eyeIcon2')">
            <svg id="eyeIcon2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>
            </svg>
          </button>
          @error('password_confirmation')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <!-- Terms -->
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" value="1" id="terms" required>
          <label class="form-check-label" for="terms">I agree to the <a href="#" class="links">Terms</a> & <a href="#" class="links">Privacy</a></label>
        </div>

        <!-- Submit -->
        <div class="mt-2">
          <button type="submit" class="btn btn-primary w-100">Create account</button>
        </div>

        <!-- Footer Links -->
        <div class="d-flex justify-content-center gap-2 links mt-3">
          <span class="text-muted">Already registered?</span>
          <a href="{{ route('login') }}" class="btn btn-outline">Sign in</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword(inputId, iconId){
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      icon.innerHTML = isPassword
        ? '<path d="M3 3l18 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" /><path d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42M9.88 5.09A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.84 17.84 0 01-4.32 4.94M6.1 6.1A17.81 17.81 0 002 12s3.5 7 10 7a10.6 10.6 0 005.9-1.9" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />'
        : '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>'
    }

    // Simple client-side password strength indicator
    const pwd = document.getElementById('password');
    const bar = document.getElementById('strengthBar');
    const txt = document.getElementById('strengthText');
    function score(p){
      let s = 0;
      if(!p) return 0;
      if(p.length >= 8) s += 25;
      if(/[A-Z]/.test(p)) s += 20;
      if(/[a-z]/.test(p)) s += 15;
      if(/\d/.test(p)) s += 20;
      if(/[^A-Za-z0-9]/.test(p)) s += 20;
      return Math.min(s,100);
    }
    function label(val){
      if(val < 35) return 'Weak';
      if(val < 70) return 'Good';
      return 'Strong';
    }
    if(pwd){
      pwd.addEventListener('input', () => {
        const val = score(pwd.value);
        bar.style.width = val + '%';
        txt.textContent = val ? `Strength: ${label(val)}` : 'Start typing to check password strength.';
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
