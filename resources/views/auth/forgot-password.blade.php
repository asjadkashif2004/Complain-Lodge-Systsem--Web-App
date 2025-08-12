<x-guest-layout>
  <!-- Bootstrap & Fonts (safe to keep even if included globally) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

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

      --logo-h:60px;        /* Adjust to resize logo */
      --radius:18px;
    }

    /* Full-height themed background inside the slot */
    .page-bg{
      position:relative; z-index:0;
      background:
        radial-gradient(55rem 55rem at 8% -20%, rgba(124,58,237,.22), transparent 60%),
        radial-gradient(50rem 50rem at 110% 0%, rgba(34,211,238,.16), transparent 60%),
        linear-gradient(180deg,var(--bg-start),var(--bg-end));
    }
    .page-bg::before{
      content:""; position:absolute; inset:0; pointer-events:none; z-index:0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size:22px 22px;
      mask-image:radial-gradient(ellipse at center, black 45%, transparent 72%);
    }

    .auth-box{position:relative; z-index:1; width:100%; max-width:460px}

    /* Refined glass card */
    .card-pro{
      background:var(--glass-bg);
      border:1px solid var(--glass-brd);
      border-radius:var(--radius);
      padding:28px 24px 26px;
      backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
      box-shadow:0 18px 50px rgba(0,0,0,.48), inset 0 1px 0 rgba(255,255,255,.04);
      transition:transform .2s ease, box-shadow .2s ease;
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

    /* Brand */
    .brand{display:grid;place-items:center;gap:10px;margin-bottom:12px}
    .brand img{
      height:var(--logo-h); width:auto; display:block; border-radius:12px;
      background:linear-gradient(135deg, rgba(91,140,255,.18), rgba(124,58,237,.18));
      padding:6px;
      box-shadow:0 10px 26px rgba(91,140,255,.22);
    }

    /* Headline */
    .headline{text-align:center;margin-bottom:16px}
    .headline h1{
      margin:0 0 6px;
      font-family:'Plus Jakarta Sans','Inter',system-ui,sans-serif;
      font-weight:700; letter-spacing:.2px;
      font-size:clamp(22px,2.2vw,26px); color:var(--text);
    }
    .headline p{margin:0;color:var(--muted);font-size:14px}

    /* Form controls */
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
      font-weight:800; padding:10px 14px; background:transparent;
      transition:transform .15s ease, box-shadow .25s ease, background-color .25s ease;
      text-decoration:none; display:inline-block; text-align:center;
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
      color:#e6ebff;
    }

    .alert-success{
      background:rgba(34,197,94,.12);
      border-color:rgba(34,197,94,.35);
      color:#d1fae5
    }
  </style>

  <div class="page-bg min-vh-100 d-flex align-items-center justify-content-center px-3">
    <div class="auth-box">
      <div class="card-pro">

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
          <h1>Forgot password</h1>
          <p>Enter your email and we’ll send you a reset link.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
          <div class="alert alert-success text-center py-2 mb-3" role="status" aria-live="polite">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" novalidate>
          @csrf

          <!-- Email -->
          <div class="mb-3 position-relative">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M3 7l9 6 9-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/>
            </svg>
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
          </div>

          <!-- Actions -->
          <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary w-100">
              Email password reset link
            </button>

            @if (Route::has('login'))
              <a href="{{ route('login') }}" class="btn-ghost position-relative w-100">
                Back to login
              </a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
