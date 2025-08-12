<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Complaint Management System</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      /* Logo size controls */
      --logo-size: 36px;           /* desktop */
      --logo-size-mobile: 30px;    /* mobile */

      /* Theme: purple + dark blue */
      --bg-start:#0a0f1f; --bg-end:#111827;
      --text:#e5e7eb; --muted:#9ca3af;
      --p1:#5b8cff; --p2:#7c3aed;

      --glass-bg:rgba(255,255,255,.06);
      --glass-brd:rgba(255,255,255,.12);
      --card-bg:#0e162e; --border:#1e2a4a;

      --ring:rgba(124,58,237,.22);
      --radius:1rem;
    }

    html,body{height:100%}
    body{
      font-family:'Instrument Sans',ui-sans-serif,system-ui,sans-serif;
      color:var(--text);
      background:
        radial-gradient(90rem 70rem at -20% -30%, #182a59 0%, transparent 60%),
        radial-gradient(100rem 80rem at 120% -30%, #2a1663 0%, transparent 60%),
        linear-gradient(180deg,var(--bg-start),var(--bg-end));
      background-attachment: fixed;
    }
    a{color:inherit;text-decoration:none}
    .text-muted{color:var(--muted)!important}
    .rounded-2xl{border-radius:var(--radius)}
    .section-pad{padding:4rem 0}

    /* NAVBAR */
    .navbar{
      backdrop-filter:saturate(180%) blur(10px);
      background:rgba(10,16,32,.55);
      border-bottom:1px solid var(--glass-brd);
    }
    .navbar .nav-link{color:var(--text); opacity:.9}
    .navbar .nav-link:hover{opacity:1}
    .navbar .btn-outline{
      border:1px solid #2a3350; color:var(--text);
      background:rgba(255,255,255,.03);
    }
    .navbar .btn-outline:hover{background:rgba(255,255,255,.07)}

    /* Brand / Logo */
    .brand-wrap{display:inline-flex;align-items:center;gap:.5rem}
    .brand-img{height:var(--logo-size);width:auto;display:block;border-radius:.6rem;background:linear-gradient(135deg,var(--p1),var(--p2));padding:2px}
    .brand-img-inner{display:block;height:calc(var(--logo-size) - 4px);width:auto;border-radius:.5rem;background:#0a0f1f}
    @media (max-width: 991.98px){
      .brand-img{height:var(--logo-size-mobile)}
      .brand-img-inner{height:calc(var(--logo-size-mobile) - 4px)}
    }
    .badge-soft{background:rgba(124,58,237,.15);color:#cbb6ff;border:1px solid rgba(124,58,237,.3)}

    /* Buttons */
    .btn-primary{
      --bs-btn-color:#fff;
      --bs-btn-bg:transparent; --bs-btn-border-color:transparent;
      background-image:linear-gradient(135deg,var(--p2),var(--p1));
      border:0; border-radius:14px; font-weight:800; letter-spacing:.2px;
      box-shadow:0 12px 28px rgba(91,140,255,.28);
      transition:transform .15s ease, box-shadow .25s ease, filter .2s ease, background-position .35s ease;
      background-size:160% 160%; background-position:0% 50%;
      position:relative; overflow:hidden;
    }
    .btn-primary:hover{transform:translateY(-2px);box-shadow:0 16px 34px rgba(91,140,255,.45);filter:brightness(1.04);background-position:100% 50%}
    .btn-primary::before{
      content:""; position:absolute; inset:0;
      background:linear-gradient(120deg,transparent,rgba(255,255,255,.35),transparent);
      transform:translateX(-120%); transition:transform .6s ease;
    }
    .btn-primary:hover::before{transform:translateX(120%)}
    .btn-outline{border:1px solid rgba(255,255,255,.16);border-radius:14px;font-weight:700;padding:.6rem 1rem}
    .btn-outline:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.28);transform:translateY(-1px)}

    /* Cards / Glass */
    .card{background:var(--card-bg); border:1px solid var(--border); color:var(--text)}
    .glass{background:var(--glass-bg); border:1px solid var(--glass-brd); backdrop-filter: blur(10px)}

    /* HERO */
    .hero-title{font-size:clamp(2rem,4vw,3rem);line-height:1.15}
    .hero-sub{max-width:58ch}
    .hero-blob{
      position:absolute; inset:auto auto -30% -20%;
      width:50vw; height:50vw; background:radial-gradient(closest-side at 30% 30%, rgba(124,58,237,.25), transparent 60%);
      filter:blur(40px); pointer-events:none; z-index:-1;
    }

    /* Info chips */
    .chip{display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);padding:.45rem .7rem;border-radius:999px}

    /* Feature tabs */
    .nav-pills .nav-link{color:#cbd5ff;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12)}
    .nav-pills .nav-link.active{color:#0b0f1e;background:linear-gradient(135deg,var(--p1),var(--p2));border-color:transparent;font-weight:700}

    /* Quick stats */
    .kpi .num{font-variant-numeric:tabular-nums;display:block}

    /* Reveal on scroll */
    .reveal{opacity:0; transform:translateY(14px); transition:opacity .6s ease, transform .6s ease}
    .reveal.show{opacity:1; transform:none}

    /* Contact form: FIXED contrast + autofill */
    .quick-form{ color-scheme: dark; } /* helps browser choose dark autofill */
    .quick-form .form-control.glass{
      background-color: rgba(255,255,255,.06) !important;
      color: var(--text) !important;
      border: 1px solid var(--glass-brd) !important;
      border-radius: .75rem; box-shadow:none;
    }
    .quick-form .form-control.glass:focus{
      background-color: rgba(255,255,255,.08) !important;
      border-color: rgba(124,58,237,.55) !important;
      box-shadow: 0 0 0 .25rem var(--ring) !important;
    }
    .quick-form .form-control.glass::placeholder{ color: color-mix(in oklab, var(--muted) 85%, transparent) }
    .quick-form input.form-control.glass:-webkit-autofill,
    .quick-form textarea.form-control.glass:-webkit-autofill{
      -webkit-text-fill-color: var(--text) !important;
      transition: background-color 9999s ease-in-out 0s;
    }

    /* Modal tweaks */
    .modal-content{background:var(--card-bg); color:var(--text); border:1px solid var(--border)}
    .form-control:focus{outline:0}

    hr.separator{border-color:#233154; opacity:.7}
    footer{border-top:1px solid var(--glass-brd); background:#0a0f1f; color:var(--muted)}

    @media (prefers-reduced-motion:reduce){
      .btn-primary,.reveal{transition:none}
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand brand-wrap" href="{{ url('/') }}" aria-label="Complaint Management System">
        <span class="brand-img">
          <img class="brand-img-inner"
               src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png"
               alt="CMS Logo" decoding="async" fetchpriority="high">
        </span>
        <span class="fw-semibold">CMS</span>
        <span class="badge badge-soft ms-2 rounded-pill">Complaint Management System</span>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="text-white"><i class="bi bi-list fs-3"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

          @if (Route::has('login'))
            @auth
              <li class="nav-item ms-lg-2"><a class="btn btn-outline btn-sm" href="{{ url('/dashboard') }}">Dashboard</a></li>
            @else
              <li class="nav-item ms-lg-2"><a class="btn btn-outline btn-sm" href="{{ route('login') }}">Login</a></li>
              @if (Route::has('register'))
                <li class="nav-item ms-lg-2"><a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a></li>
              @endif
            @endauth
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="section-pad position-relative">
    <div class="hero-blob"></div>
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-7 reveal">
          <div class="chip mb-3">
            <i class="bi bi-shield-lock-fill text-primary"></i>
            <span>Secure • Trackable • Transparent</span>
          </div>
          <h1 class="hero-title mt-2 mb-2">Resolve complaints faster with clarity and control.</h1>
          <p class="text-muted hero-sub mb-4">
            A Laravel-powered platform to <strong>submit</strong>, <strong>assign</strong>, and <strong>track</strong> complaints.
            Real-time status, SLAs, role-based dashboards, and exports—built for teams.
          </p>
          <div class="d-flex flex-wrap gap-2">
            @if (Route::has('complaints.create'))
              <a class="btn btn-primary btn-lg" href="{{ route('complaints.create') }}"><i class="bi bi-send me-2"></i>File a Complaint</a>
            @else
              <a class="btn btn-primary btn-lg" href="#"><i class="bi bi-send me-2"></i>File a Complaint</a>
            @endif

            <button class="btn btn-outline btn-lg" data-bs-toggle="modal" data-bs-target="#trackModal">
              <i class="bi bi-search me-2"></i>Track Complaint
            </button>
          </div>

          <!-- Quick KPIs -->
          <div class="row row-cols-3 g-3 mt-4 kpi">
            <div class="col text-center">
              <span class="num display-6 fw-bold" data-count-to="98">0</span>
              <div class="text-muted">On-time SLAs</div>
            </div>
            <div class="col text-center">
              <span class="num display-6 fw-bold" data-count-to="10000" data-format="short">0</span>
              <div class="text-muted">Resolved</div>
            </div>
            <div class="col text-center">
              <span class="num display-6 fw-bold" data-count-to="4.8" data-decimals="1">0</span>
              <div class="text-muted">User rating</div>
            </div>
          </div>
        </div>

        <div class="col-lg-5 reveal">
          <div class="card rounded-2xl p-4 shadow-lg">
            <h5 class="mb-3">Highlights</h5>
            <ul class="mb-3 ps-3">
              <li>Categories & priorities</li>
              <li>Attachments & notes</li>
              <li>Exports (CSV / Excel)</li>
            </ul>

            <!-- Tabs: who it's for -->
            <ul class="nav nav-pills gap-2 mb-3" id="useTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="citizen-tab" data-bs-toggle="pill" data-bs-target="#citizen" type="button" role="tab">Citizens</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="agent-tab" data-bs-toggle="pill" data-bs-target="#agent" type="button" role="tab">Agents</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-tab" data-bs-toggle="pill" data-bs-target="#admin" type="button" role="tab">Admins</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="citizen" role="tabpanel">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-check2-circle text-success mt-1"></i>
                  <p class="mb-0 text-muted">Simple 2-minute filing, live updates, and email/SMS notifications.</p>
                </div>
              </div>
              <div class="tab-pane fade" id="agent" role="tabpanel">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-kanban text-info mt-1"></i>
                  <p class="mb-0 text-muted">Queues, SLA timers, internal notes, and quick actions in one place.</p>
                </div>
              </div>
              <div class="tab-pane fade" id="admin" role="tabpanel">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-graph-up-arrow text-warning mt-1"></i>
                  <p class="mb-0 text-muted">Analytics, exports, RBAC, and audit trails for full oversight.</p>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </header>

  <!-- FEATURES -->
  <section id="features" class="section-pad pt-0">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4 reveal">
          <div class="card rounded-2xl p-4 h-100">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-list-check me-2"></i><h5 class="mb-0">Smart Intake</h5>
            </div>
            <p class="text-muted mb-0">Auto-assignment rules, categories, priority levels, and duplicate detection.</p>
          </div>
        </div>
        <div class="col-md-4 reveal">
          <div class="card rounded-2xl p-4 h-100">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-kanban me-2"></i><h5 class="mb-0">Team Queues</h5>
            </div>
            <p class="text-muted mb-0">Agent workloads, SLA timers, escalations, and internal notes in one place.</p>
          </div>
        </div>
        <div class="col-md-4 reveal">
          <div class="card rounded-2xl p-4 h-100">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-graph-up-arrow me-2"></i><h5 class="mb-0">Analytics</h5>
            </div>
            <p class="text-muted mb-0">Closure time, backlog trend, and satisfaction—exportable reports for management.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="section-pad pt-0">
    <div class="container">
      <div class="card rounded-2xl p-4 reveal">
        <h4 class="mb-2">About the System</h4>
        <p class="text-muted mb-0">
          Built on <strong>Laravel</strong> for speed and reliability. Designed for departments handling internal or customer
          complaints at scale. Integrates with email/SMS and offers a clean REST API.
        </p>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="section-pad pt-0">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-6 reveal">
          <div class="card rounded-2xl p-4 h-100">
            <h4 class="mb-2">Contact</h4>
            <p class="text-muted">Need help or a demo? Reach out.</p>
            <ul class="list-unstyled mb-0">
              <li class="mb-1"><i class="bi bi-envelope me-2"></i>Email: <a href="mailto:asjadkashif2004@gmail.com">asjadkashif2004@gmail.com</a></li>
              <li class="mb-1"><i class="bi bi-telephone me-2"></i>Phone: +92-xxxx-xxxx</li>
              <li class="mb-1"><i class="bi bi-clock me-2"></i>Mon–Fri, 9am–6pm PKT</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-6 reveal">
          <div class="card rounded-2xl p-4 h-100">
            <h5 class="mb-3">Quick Message</h5>
            <form method="POST" action="#" class="quick-form">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control glass" name="name" placeholder="Your name">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control glass" type="email" name="email" placeholder="you@company.com">
              </div>
              <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control glass" rows="4" name="message" placeholder="How can we help?"></textarea>
              </div>
              <button class="btn btn-primary"><i class="bi bi-send me-2"></i>Send</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="py-4">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
      <span>© {{ date('Y') }} Complaint Management System</span>
      <div class="d-flex gap-3">
        <a href="#about">About</a>
        <a href="#features">Features</a>
        <a href="#contact">Contact</a>
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
      </div>
    </div>
  </footer>

  <!-- Track Complaint Modal -->
  <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-2xl">
        <div class="modal-header">
          <h5 class="modal-title" id="trackModalLabel"><i class="bi bi-search me-2"></i>Track Complaint</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="GET" action="{{ Route::has('complaints.track') ? route('complaints.track') : '#' }}">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Complaint Reference</label>
              <input class="form-control glass" name="ref" placeholder="e.g. CMP-2025-00123" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email (for verification)</label>
              <input class="form-control glass" type="email" name="email" placeholder="you@domain.com" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary w-100" type="submit">Check Status</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Micro-interactions: counters + scroll reveal -->
  <script>
    // Animate counters
    function animateCount(el){
      const to = parseFloat(el.dataset.countTo || '0');
      const decimals = parseInt(el.dataset.decimals || '0', 10);
      const format = el.dataset.format || '';
      const dur = 1200; // ms
      const start = performance.now();
      const from = 0;

      function tick(now){
        const p = Math.min(1, (now - start)/dur);
        const val = from + (to - from) * (1 - Math.pow(1 - p, 3)); // easeOutCubic
        let out = val.toFixed(decimals);
        if(format === 'short'){
          const v = val;
          if(v >= 1e6) out = (v/1e6).toFixed(1) + 'M';
          else if(v >= 1e3) out = (v/1e3).toFixed(1) + 'k';
          else out = Math.round(v);
        }
        el.textContent = out;
        if(p < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    }

    // Reveal on scroll
    const reveals = document.querySelectorAll('.reveal');
    const kpis = document.querySelectorAll('.kpi .num');
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(entry=>{
        if(entry.isIntersecting){
          entry.target.classList.add('show');
          if(entry.target.classList.contains('kpi')) {
            entry.target.querySelectorAll('.num').forEach(animateCount);
          }
          // run counters on first view
          if(entry.target.matches('.kpi .num')) animateCount(entry.target);
          // Unobserve once shown
          io.unobserve(entry.target);
        }
      });
    }, {threshold: 0.18});

    reveals.forEach(el=>io.observe(el));
    kpis.forEach(el=>io.observe(el));
  </script>
</body>
</html>
