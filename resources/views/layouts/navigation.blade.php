<!-- resources/views/layouts/navigation.blade.php -->
@php
  $isAdmin = auth()->check() && strtolower(auth()->user()->role ?? '') === 'admin';
@endphp

<nav class="navbar navbar-expand-lg navbar-pro sticky-top py-2" data-bs-theme="dark">
  <div class="container-fluid px-3 px-md-4">

    <!-- Brand (logo locked to 28px) -->
    <a class="navbar-brand d-flex align-items-center gap-2"
       href="{{ $isAdmin ? route('admin.dashboard') : route('dashboard') }}">
      <img src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png"
           alt="Logo" class="brand-logo me-1" height="28" />
      <span class="brand-name">Complaint Lodge System</span>
    </a>

    <!-- Mobile toggler -->
    <button class="navbar-toggler border-0 shadow-none px-2" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto align-items-lg-center gap-lg-1">

        @if($isAdmin)
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
              <i class="bi bi-speedometer2 me-1"></i><span>Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('complaints.index') ? 'active' : '' }}"
               href="{{ route('complaints.index') }}">
              <i class="bi bi-folder-check me-1"></i><span>Manage Complaints</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.complaints') ? 'active' : '' }}"
               href="{{ route('admin.complaints') }}">
              <i class="bi bi-arrow-repeat me-1"></i><span>Update Status</span>
            </a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               href="{{ route('dashboard') }}">
              <i class="bi bi-speedometer2 me-1"></i><span>My Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}"
               href="{{ route('complaints.create') }}">
              <i class="bi bi-pencil-square me-1"></i><span>File Complaint</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('complaints.index') ? 'active' : '' }}"
               href="{{ route('complaints.index') }}">
              <i class="bi bi-journal-text me-1"></i><span>My Complaints</span>
            </a>
          </li>
        @endif
      </ul>

      <!-- Profile -->
      @auth
      <ul class="navbar-nav ms-lg-3">
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle d-flex align-items-center"
             href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-5 me-2"></i>
            <span class="fw-semibold">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-lg glass-menu">
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2"
                 href="{{ route('profile.edit') }}">
                <i class="bi bi-gear text-secondary"></i><span>Profile</span>
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <!-- Use a link that submits a hidden POST form to avoid any dropdown glitches -->
              <a href="#" class="dropdown-item d-flex align-items-center gap-2 text-danger"
                 data-logout="true">
                <i class="bi bi-box-arrow-right"></i><span>Log Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>

      <!-- Hidden logout form (works anywhere, any page) -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
      @endauth

    </div>
  </div>
</nav>

<!-- Bootstrap Icons -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
  :root{
    --bg-start:#0f172a; --bg-end:#111827;
    --glass-bg:rgba(255,255,255,.06); --glass-brd:rgba(255,255,255,.14);
    --text:#e5e7eb; --muted:#a3a3a3;
    --primary-1:#5b8cff; --primary-2:#7c3aed;
  }

  .navbar-pro{
    background:
      radial-gradient(28rem 28rem at 10% -60%, rgba(124,58,237,.25), transparent 60%),
      linear-gradient(90deg, #1b2350, #0f1a3a 60%, #0d132b);
    border-bottom:1px solid rgba(255,255,255,.08);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 8px 30px rgba(0,0,0,.35);
    z-index: 1035; /* above content */
  }

  .brand-logo{
    height:28px !important; width:auto !important; max-height:28px !important;
    object-fit:contain; filter: drop-shadow(0 1px 4px rgba(0,0,0,.25));
  }
  .brand-name{
    color:#f8fafc; font-weight:700; letter-spacing:.2px;
    font-size: clamp(.95rem, 1.2vw, 1.1rem); white-space: nowrap;
  }

  .nav-link{
    color: var(--text) !important; opacity:.9;
    padding:.5rem .75rem; border-radius:.6rem; display:flex; align-items:center;
    transition: color .2s ease, opacity .2s ease, background-color .2s ease, transform .2s ease;
  }
  .nav-link:hover{ opacity:1; background-color: rgba(255,255,255,.08); transform: translateY(-1px); }
  .nav-link.active{
    color:#fff !important; background-color: rgba(255,255,255,.10);
  }
  .nav-link.active::after{
    content:""; position:absolute; left:12px; right:12px; bottom:4px; height:3px; border-radius:999px;
    background-image: linear-gradient(90deg, var(--primary-2), var(--primary-1));
    box-shadow: 0 6px 16px rgba(91,140,255,.45);
  }

  /* Glass dropdown – ALWAYS on top */
  .glass-menu{
    background: rgba(17,24,39,.95) !important;
    border:1px solid var(--glass-brd) !important;
    border-radius:14px; padding:.5rem; color:var(--text);
    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
    z-index: 2000;  /* fix: stay above page/table/cards */
  }
  .dropdown-item{ border-radius:.6rem; }
  .dropdown-item:hover{ color:#fff; background: rgba(255,255,255,.10); }
  .dropdown-divider{ border-color: rgba(255,255,255,.12); }

  .navbar-toggler-icon{
    width:1.6rem; height:1.6rem;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.85)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }
  .navbar-toggler:focus{ box-shadow: 0 0 0 .2rem rgba(124,58,237,.35) !important; }

  @media (max-width: 991.98px){
    .nav-link{ padding:.65rem .8rem; }
    .navbar-pro{ padding-top:.35rem; padding-bottom:.35rem; }
  }
  @media (prefers-reduced-motion: reduce){
    .nav-link, .navbar-pro{ transition:none !important; }
  }
</style>

<script>
  // Safe logout from dropdown (works even if dropdown closes quickly)
  document.addEventListener('click', function(e){
    const link = e.target.closest('[data-logout]');
    if(link){
      e.preventDefault();
      const form = document.getElementById('logout-form');
      if(form){ form.submit(); }
    }
  });
</script>
