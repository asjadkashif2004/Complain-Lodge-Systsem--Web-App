<!-- resources/views/layouts/navigation.blade.php -->
<nav class="navbar navbar-expand-lg navbar-custom py-2">
    <div class="container-fluid px-4">

        <!-- Logo & Brand -->
        <a class="navbar-brand d-flex align-items-center" 
           href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
            <img src="https://cms-demo.squadcloud.co/Settings/MainLogo/1723712619.png" 
                 alt="Logo" height="28" class="me-2">
            <span class="text-white fw-semibold">Complaint Lodge System</span>
        </a>

        <!-- Mobile Menu Button -->
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">

                @if(Auth::user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('complaints.index') ? 'active' : '' }}" href="{{ route('complaints.index') }}"><i class="bi bi-folder-check me-1"></i> Manage Complaints</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.complaints') ? 'active' : '' }}" href="{{ route('admin.complaints') }}"><i class="bi bi-arrow-repeat me-1"></i> Update Status</a></li>
                @else
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> My Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}" href="{{ route('complaints.create') }}"><i class="bi bi-pencil-square me-1"></i> File Complaint</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('complaints.index') ? 'active' : '' }}" href="{{ route('complaints.index') }}"><i class="bi bi-journal-text me-1"></i> My Complaints</a></li>
                @endif

            </ul>

            <!-- Profile Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 me-2"></i>
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear me-2 text-secondary"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center text-danger" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    /* Navbar Styling */
    .navbar-custom {
        background: linear-gradient(90deg, #4c68d7, #1b3a82);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .navbar-brand img {
        max-height: 28px;
    }
    .navbar-brand span {
        font-weight: 500;
        font-size: 1.1rem;
        color: #f8f9fa;
    }
    .nav-link {
        color: #e0e0e0 !important;
        padding: 6px 12px;
        transition: 0.3s;
        border-radius: 6px;
        font-size: 0.95rem;
    }
    .nav-link:hover,
    .nav-link.active {
        background-color: rgba(255,255,255,0.12);
        color: #fff !important;
    }
    .dropdown-menu {
        border-radius: 8px;
        padding: 0.4rem;
        font-size: 0.9rem;
    }
    .dropdown-item {
        padding: 8px 12px;
        border-radius: 6px;
    }
    .dropdown-item:hover {
        background-color: #f1f1f1;
    }
</style>
