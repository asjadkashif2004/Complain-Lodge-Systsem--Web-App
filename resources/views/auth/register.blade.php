<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>

  <!-- Bootstrap & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet" />

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
      margin:0; padding:clamp(16px,2vw,32px);
      color:var(--text);
      font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
      background:
        radial-gradient(60rem 60rem at 10% -20%, rgba(124,58,237,.22), transparent 60%),
        radial-gradient(50rem 50rem at 110% 0%, rgba(34,211,238,.16), transparent 60%),
        linear-gradient(180deg, var(--bg-start), var(--bg-end));
      display:grid; place-items:center;
    }

    /* subtle grid mask */
    body::before{
      content:"";position:fixed;inset:0;pointer-events:none;z-index:0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size:22px 22px;
      mask-image:radial-gradient(ellipse at center, black 45%, transparent 72%);
    }

    .auth-wrap{position:relative;z-index:1;width:100%;max-width:480px}
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
    .card-pro::before{
      content:""; position:absolute; inset:-1px; border-radius:calc(var(--radius) + 1px);
      padding:1px;
      background:linear-gradient(135deg, rgba(91,140,255,.55), rgba(124,58,237,.45));
      -webkit-mask:linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
      -webkit-mask-composite:xor; mask-composite:exclude;
      opacity:.35; pointer-events:none;
    }

    .brand{display:grid;place-items:center;gap:10px;margin-bottom:12px}
    .brand img{
      height:var(--logo-h);width:auto;display:block;border-radius:12px;
      background:linear-gradient(135deg, rgba(91,140,255,.18), rgba(124,58,237,.18));
      padding:6px; box-shadow:0 10px 26px rgba(91,140,255,.22);
    }

    .headline{text-align:center;margin-bottom:16px}
    .headline h1{
      margin:0 0 6px;
      font-family:'Plus Jakarta Sans','Inter',system-ui,sans-serif;
      font-weight:700; letter-spacing:.2px;
      font-size:clamp(22px,2.2vw,26px);
    }
    .headline p{margin:0;color:var(--muted);font-size:14px}

    .form-label{color:var(--text);font-weight:600;font-size:.95rem}
    .form-text{color:var(--muted)}

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

    /* primary & ghost buttons */
    .btn-primary{
      --bs-btn-color:#0b1020;
      --bs-btn-bg:transparent; --bs-btn-border-color:transparent;
      position:relative; overflow:hidden; border-radius:14px; border:none;
      font-weight:800; letter-spacing:.2px; padding:12px 16px;
      background-image:linear-gradient(120deg, var(--violet), var(--blue));
      box-shadow:0 10px 24px rgba(91,140,255,.3), 0 0 0 1px rgba(255,255,255,.06) inset;
      transition:transform .15s ease, box-shadow .25s ease, filter .2s ease, background-position .35s ease;
      background-size:160% 160%; background-position:0% 50%;
    }
    .btn-primary:hover{
      transform:translateY(-2px);
      box-shadow:0 14px 30px rgba(91,140,255,.45), 0 0 0 1px rgba(255,255,255,.1) inset;
      filter:brightness(1.04); background-position:100% 50%;
    }
    .btn-primary:active{transform:translateY(0)}

    .btn-outline{
      color:#e6ebff; border:1px solid rgba(255,255,255,.18);
      border-radius:14px; font-weight:700; padding:10px 14px; background:transparent;
      transition:all .25s ease;
    }
    .btn-outline:hover{
      background:linear-gradient(120deg, rgba(91,140,255,.14), rgba(124,58,237,.14));
      border-color:rgba(255,255,255,.28);
      transform:translateY(-1px);
      box-shadow:0 8px 22px rgba(124,58,237,.25);
    }

    /* password toggle */
    .reveal{
      position:absolute;right:8px;top:50%;transform:translateY(-50%);
      background:transparent;border:0;padding:6px;border-radius:8px;color:var(--muted);
      transition:background-color .2s ease,color .2s ease;cursor:pointer
    }
    .reveal:hover{background:rgba(255,255,255,.08);color:var(--text)}

    /* strength meter */
    .progress{height:6px;border-radius:999px;background:rgba(255,255,255,.08)}
    .progress-bar{background-image:linear-gradient(90deg, var(--violet), var(--blue))}
    .progress-bar.weak{background:#ef4444}
    .progress-bar.good{background:#f59e0b}
    .progress-bar.strong{background:#22c55e}

    @media (prefers-reduced-motion:reduce){
      .btn-primary,.card-pro{transition:none}
    }
  </style>
</head>
<body>
  <div class="auth-wrap">
    <div class="card-pro">
      <!-- Brand -->
      <div class="brand">
        <img src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png" alt="Logo" loading="lazy"/>
      </div>

      <!-- Headline -->
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
          <input id="name" type="text"
                 class="form-control @error('name') is-invalid @enderror"
                 name="name" value="{{ old('name') }}" required autofocus autocomplete="name"/>
          <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
               xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M12 12a5 5 0 100-10 5 5 0 000 10z" stroke="currentColor" stroke-width="1.6"/>
            <path d="M3 22a9 9 0 0118 0" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
          </svg>
          @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3 position-relative">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email"
                 class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}" required autocomplete="username"/>
          <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
               xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
                 name="password" required autocomplete="new-password"/>
          <button type="button" class="reveal" aria-label="Toggle password visibility"
                  onclick="togglePassword('password','eyeIcon1')">
            <svg id="eyeIcon1" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>
            </svg>
          </button>
          @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Strength meter -->
        <div class="mb-3">
          <div class="progress" role="progressbar" aria-label="Password strength" aria-valuemin="0" aria-valuemax="100">
            <div id="strengthBar" class="progress-bar" style="width:0%"></div>
          </div>
          <small id="strengthText" class="form-text">Use 8+ characters, with numbers & symbols.</small>
        </div>

        <!-- Confirm Password -->
        <div class="mb-2 position-relative">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input id="password_confirmation" type="password"
                 class="form-control @error('password_confirmation') is-invalid @enderror"
                 name="password_confirmation" required autocomplete="new-password"/>
          <button type="button" class="reveal" aria-label="Toggle password visibility"
                  onclick="togglePassword('password_confirmation','eyeIcon2')">
            <svg id="eyeIcon2" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>
            </svg>
          </button>
          @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Terms -->
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" value="1" id="terms" required>
          <label class="form-check-label" for="terms">
            I agree to the <a href="#" class="text-decoration-none" style="color:#c7d2fe">Terms</a> &amp;
            <a href="#" class="text-decoration-none" style="color:#c7d2fe">Privacy</a>
          </label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100">Create account</button>

        <!-- Footer Links -->
        <div class="d-flex justify-content-center gap-2 mt-3">
          <span class="text-muted">Already registered?</span>
          <a href="{{ route('login') }}" class="btn btn-outline py-2 px-3">Sign in</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword(inputId, iconId){
      const input = document.getElementById(inputId);
      const icon  = document.getElementById(iconId);
      const isPwd = input.type === 'password';
      input.type  = isPwd ? 'text' : 'password';
      icon.innerHTML = isPwd
        ? '<path d="M3 3l18 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>' +
          '<path d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>' +
          '<path d="M9.88 5.09A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.84 17.84 0 01-4.32 4.94" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>' +
          '<path d="M6.1 6.1A17.81 17.81 0 002 12s3.5 7 10 7a10.6 10.6 0 005.9-1.9" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>'
        : '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>' +
          '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>';
    }

    // Password strength meter (simple, readable)
    const pwd = document.getElementById('password');
    const bar = document.getElementById('strengthBar');
    const txt = document.getElementById('strengthText');

    function score(p){
      let s = 0; if(!p) return 0;
      if(p.length >= 8) s += 25;
      if(p.length >= 12) s += 10;
      if(/[A-Z]/.test(p)) s += 20;
      if(/[a-z]/.test(p)) s += 10;
      if(/\d/.test(p))   s += 20;
      if(/[^A-Za-z0-9]/.test(p)) s += 20;
      return Math.min(s, 100);
    }
    function label(val){
      if(val < 35) return 'Weak';
      if(val < 70) return 'Good';
      return 'Strong';
    }
    function cls(val){
      if(val < 35) return 'weak';
      if(val < 70) return 'good';
      return 'strong';
    }
    if(pwd){
      pwd.addEventListener('input', () => {
        const val = score(pwd.value);
        bar.style.width = val + '%';
        bar.classList.remove('weak','good','strong');
        bar.classList.add(cls(val));
        txt.textContent = val ? `Strength: ${label(val)}` : 'Use 8+ characters, with numbers & symbols.';
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
