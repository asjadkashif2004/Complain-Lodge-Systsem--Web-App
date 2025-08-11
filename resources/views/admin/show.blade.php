@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
  :root{
    --bg-start:#0f172a; --bg-end:#111827;
    --glass-bg:rgba(255,255,255,.06); --glass-brd:rgba(255,255,255,.14);
    --text:#e5e7eb; --muted:#9ca3af;
    --primary-1:#5b8cff; --primary-2:#7c3aed;
  }

  /* Page canvas */
  .admin-theme{
    background:
      radial-gradient(65rem 65rem at 10% -50%, rgba(124,58,237,.22), transparent 60%),
      radial-gradient(55rem 55rem at 110% 0%, rgba(34,211,238,.14), transparent 60%),
      linear-gradient(180deg, var(--bg-start), var(--bg-end));
    min-height: 100vh;
    color: var(--text);
    padding: 1.25rem 0;
  }

  /* 🔧 Kill leftover white backgrounds from layout/Bootstrap */
  .admin-theme .bg-white,
  .admin-theme .card,
  .admin-theme .card-body,
  .admin-theme .table,
  .admin-theme .list-group,
  .admin-theme .alert,
  .admin-theme .modal-content {
    background: transparent !important;
  }
  .admin-theme .shadow-sm,
  .admin-theme .shadow,
  .admin-theme .border,
  .admin-theme .card,
  .admin-theme .card-body { border-color: rgba(255,255,255,.14) !important; }

  /* Glass card */
  .card-glass{
    background: var(--glass-bg) !important;
    border: 1px solid var(--glass-brd) !important;
    border-radius: 16px;
    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 12px 30px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.04);
    color: var(--text);
  }
  .card-header-glass{
    background: linear-gradient(90deg, rgba(124,58,237,.25), rgba(91,140,255,.25)) !important;
    border-bottom: 1px solid rgba(255,255,255,.10) !important;
    color:#fff;
    border-top-left-radius: 16px; border-top-right-radius: 16px;
  }

  /* Controls */
  .btn-primary{
    border: none; border-radius: 12px; font-weight: 700;
    background-image: linear-gradient(90deg, var(--primary-2), var(--primary-1));
    box-shadow: 0 10px 26px rgba(91,140,255,.35);
    transition: transform .18s ease, box-shadow .25s ease, filter .2s ease;
    color:#fff;
  }
  .btn-primary:hover{ transform: translateY(-1px); box-shadow:0 16px 36px rgba(91,140,255,.5); filter:brightness(1.03) }
  .btn-outline{
    background: transparent; color: var(--text); border-radius: 12px; font-weight: 600;
    border: 1px solid rgba(255,255,255,.18);
  }
  .btn-outline:hover{ background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.28); color:#fff; }

  /* Toolbar fields */
  .toolbar .form-control, .toolbar .form-select{
    background: rgba(255,255,255,.06) !important; color:#fff !important;
    border:1px solid rgba(255,255,255,.14) !important;
    border-radius: 10px;
  }
  .toolbar .form-control::placeholder{ color: #cbd5e1; opacity:.75; }

  /* TABLE: keep it dark/glassy */
  .table-responsive{ background: transparent !important; }
  .table-glass {
    --bs-table-bg: transparent !important;
    background: rgba(15, 23, 42, 0.55) !important;
    border-radius: 12px;
    color: var(--text);
  }
  .table-glass > :not(caption) > * > * {
    background-color: transparent !important;
    box-shadow: none !important;
    color: var(--text) !important;
  }
  .table-glass thead th {
    color:#d1d5db; font-weight:700;
    border-color: rgba(255,255,255,.08) !important;
    background: rgba(255,255,255,.04) !important;
  }
  .table-glass tbody td{ border-color: rgba(255,255,255,.06) !important; }
  .table-glass tbody tr:hover{ background: rgba(255,255,255,.04) !important; }

  /* Dark dropdown menus */
  .dropdown-menu {
    background: rgba(17, 24, 39, 0.92) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.45);
    padding: .4rem;
  }
  .dropdown-menu .dropdown-item{
    color: #e5e7eb !important;
    border-radius: 8px; padding: .5rem .75rem;
  }
  .dropdown-menu .dropdown-item:hover{ background: rgba(255,255,255,.08) !important; color:#fff !important; }
  .dropdown-divider{ border-color: rgba(255,255,255,.1) !important; }

  /* Status chips */
  .status-badge{
    font-size: .8rem; font-weight:700; padding:.35rem .6rem; border-radius:999px;
    border:1px solid rgba(255,255,255,.22); display:inline-block;
  }
  .st-pending  { background: rgba(148,163,184,0.18); color:#e5eaf5; }
  .st-progress { background: rgba(245,158,11,0.22); color:#fff3c4; }
  .st-resolved { background: rgba(34,197,94,0.22); color:#ccf7da; }
  .st-rejected { background: rgba(239,68,68,0.22); color:#ffd1d1; }

  /* Dark select (status) */
  .select-dark{
    color-scheme: dark;
    background: rgba(255,255,255,.06) !important;
    color:#e5e7eb !important;
    border:1px solid rgba(255,255,255,.14) !important;
    border-radius:10px !important;
  }
  .select-dark:focus{
    border-color: rgba(124,58,237,.6) !important;
    box-shadow: 0 0 0 4px rgba(124,58,237,.18) !important;
  }
  .select-dark option{ background:#0f172a; color:#e5e7eb; }

  /* Pagination dark */
  .pagination .page-link{
    background: rgba(255,255,255,.06); color:#e5e7eb; border-color: rgba(255,255,255,.14);
  }
  .pagination .page-link:hover{ background: rgba(255,255,255,.12); color:#fff; }
  .pagination .active .page-link{ background: linear-gradient(90deg,var(--primary-2),var(--primary-1)); border-color: transparent; }
</style>

<div class="admin-theme">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-11">
        <div class="card-glass mb-4">
          <!-- Header -->
          <div class="card-header-glass d-flex flex-wrap gap-2 justify-content-between align-items-center p-3 p-md-4">
            <h4 class="mb-0 d-flex align-items-center">
              <i class="bi bi-clipboard-check me-2"></i> Manage Complaints
            </h4>
            <div class="d-flex gap-2">
              <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" style="background:rgba(255,255,255,.12); color:#fff; border:1px solid rgba(255,255,255,.2); border-radius:10px;">
                  <i class="bi bi-gear-fill me-1"></i> Admin Options
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                  <li><a class="dropdown-item" href="#"><i class="bi bi-bar-chart me-1"></i> View Reports</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-arrow-down me-1"></i> Export Data</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-sliders me-1"></i> Settings</a></li>
                </ul>
              </div>
              <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> New Complaint
              </a>
            </div>
          </div>

          <!-- Toolbar -->
          <div class="toolbar p-3 p-md-4 pt-3 border-bottom border-0" style="border-color: rgba(255,255,255,.08)!important;">
            <form action="{{ route('complaints.index') }}" method="GET" class="row g-2 align-items-end">
              <div class="col-12 col-md-4">
                <label class="form-label text-white-50 small mb-1">Search</label>
                <input name="q" class="form-control" placeholder="Search by title, description or user..." value="{{ request('q') }}">
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label text-white-50 small mb-1">Status</label>
                <select class="form-select select-dark" name="status">
                  <option value="">All</option>
                  @php $st=request('status'); @endphp
                  <option value="Pending" {{ $st=='Pending'?'selected':'' }}>Pending</option>
                  <option value="In Progress" {{ $st=='In Progress'?'selected':'' }}>In Progress</option>
                  <option value="Resolved" {{ $st=='Resolved'?'selected':'' }}>Resolved</option>
                  <option value="Rejected" {{ $st=='Rejected'?'selected':'' }}>Rejected</option>
                </select>
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label text-white-50 small mb-1">Sort</label>
                <select class="form-select select-dark" name="sort">
                  @php $so=request('sort'); @endphp
                  <option value="recent" {{ $so=='recent'?'selected':'' }}>Most Recent</option>
                  <option value="oldest" {{ $so=='oldest'?'selected':'' }}>Oldest</option>
                  <option value="status" {{ $so=='status'?'selected':'' }}>Status</option>
                </select>
              </div>
              <div class="col-12 col-md-2 d-grid">
                <button class="btn btn-outline"><i class="bi bi-search me-1"></i> Apply</button>
              </div>
            </form>
          </div>

          <!-- Table -->
          <div class="p-3 p-md-4">
            @if($complaints->isEmpty())
              <div class="text-center py-5" style="color:var(--muted);">
                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                <div>No complaints found.</div>
                <div class="mt-3">
                  <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-square me-1"></i> Create your first complaint
                  </a>
                </div>
              </div>
            @else
              @php $offset = method_exists($complaints,'firstItem') ? ($complaints->firstItem() - 1) : 0; @endphp
              <div class="table-responsive">
                <table class="table table-glass align-middle text-center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User ID</th>
                      <th class="text-start">Title</th>
                      <th class="text-start">Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($complaints as $complaint)
                      @php
                        $statusClass = match($complaint->status){
                          'Resolved' => 'st-resolved',
                          'In Progress' => 'st-progress',
                          'Rejected' => 'st-rejected',
                          default => 'st-pending'
                        };
                      @endphp
                      <tr>
                        <td>{{ $offset + $loop->iteration }}</td>
                        <td class="text-white-50">{{ $complaint->user_id }}</td>
                        <td class="text-white text-start">{{ $complaint->title }}</td>
                        <td class="text-start text-white-50">{{ Str::limit($complaint->description, 80) }}</td>
                        <td><span class="status-badge {{ $statusClass }}">{{ $complaint->status }}</span></td>
                        <td>
                          <div class="d-flex flex-column flex-lg-row gap-2 justify-content-center">
                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-outline btn-sm">
                              <i class="bi bi-eye"></i> View
                            </a>
                            <form method="POST" action="{{ route('admin.complaints.updateStatus', $complaint->id) }}" class="d-flex gap-2">
                              @csrf
                              <select name="status" class="form-select form-select-sm select-dark" required style="min-width: 160px;">
                                <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="Rejected" {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                              </select>
                              <button type="submit" class="btn btn-primary btn-sm" title="Update status">
                                <i class="bi bi-check2-circle"></i>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              @if(method_exists($complaints, 'links'))
                <div class="d-flex justify-content-end mt-3">
                  {{ $complaints->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
              @endif
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
