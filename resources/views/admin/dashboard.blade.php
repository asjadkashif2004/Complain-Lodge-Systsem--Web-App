@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
  :root{
    --bg-1:#0d1323; --bg-2:#0a1020; --bg-3:#070c18;
    --glass:rgba(255,255,255,.055); --glass-brd:rgba(255,255,255,.12);
    --text:#ecf0f8; --muted:#a8b2c6;
    --pri-1:#7c3aed; --pri-2:#5b8cff;
    --row-hover:rgba(60,100,185,.14);
  }

  /* Page background (no light bands) */
  html,body{height:100%; background:var(--bg-2);}
  .admin-page{
    position:relative; min-height:100vh; color:var(--text);
    background:
      radial-gradient(90rem 55rem at 120% -10%, rgba(124,58,237,.16), transparent 60%),
      radial-gradient(70rem 45rem at -20% 5%, rgba(34,211,238,.12), transparent 65%),
      linear-gradient(180deg, var(--bg-1), var(--bg-2) 55%, var(--bg-3));
    padding: 1.5rem 0 3.25rem;
  }
  .admin-page::after{
    content:""; position:absolute; inset:0; pointer-events:none;
    background-image:
      linear-gradient(transparent 31px, rgba(255,255,255,.02) 32px),
      linear-gradient(90deg, transparent 31px, rgba(255,255,255,.02) 32px);
    background-size:32px 32px; opacity:.28;
  }

  /* Nuke stray whites from parent layout */
  .admin-page .bg-white, .admin-page .card, .admin-page .table, .admin-page .alert,
  .admin-page .list-group, .admin-page .modal-content { background:transparent!important; color:var(--text); }

  /* Frame keeps content grounded (no “floating panel” strip) */
  .frame{
    border-radius:18px; overflow:hidden; position:relative;
    background: linear-gradient(180deg, rgba(255,255,255,.035), rgba(255,255,255,.02));
    border:1px solid rgba(255,255,255,.06);
    box-shadow: 0 28px 60px rgba(0,0,0,.55);
  }

  /* Heading + buttons */
  .title{
    background: linear-gradient(90deg,#e6e9f5,#bdc8ff 55%,#d7b8ff);
    -webkit-background-clip:text; background-clip:text; color:transparent;
    letter-spacing:.2px;
  }
  .btn-primary{
    border:none; border-radius:12px; font-weight:800; color:#fff;
    background-image: linear-gradient(90deg, var(--pri-1), var(--pri-2));
    box-shadow: 0 12px 26px rgba(91,140,255,.36);
    transition: transform .18s ease, box-shadow .25s ease, filter .2s ease;
  }
  .btn-primary:hover{ transform:translateY(-2px); box-shadow:0 20px 40px rgba(91,140,255,.5); filter:brightness(1.04) }
  .btn-outline{
    background: transparent; color: var(--text); border-radius:12px;
    border:1px solid rgba(255,255,255,.18); font-weight:700;
    transition: all .2s ease;
  }
  .btn-outline:hover{ background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.28); color:#fff; }
  .btn-link-muted{ color:#cfd6e6; text-decoration:none; }
  .btn-link-muted:hover{ color:#fff; text-decoration:underline; }

  /* Glass cards / KPI */
  .card-glass{
    background:var(--glass); border:1px solid var(--glass-brd);
    border-radius:14px; backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px);
    box-shadow: 0 12px 28px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.05);
  }
  .kpi{ transition: transform .18s ease, box-shadow .25s ease, border-color .2s ease; }
  .kpi:hover{ transform: translateY(-2px); box-shadow: 0 18px 38px rgba(0,0,0,.45); border-color:rgba(124,58,237,.35); }
  .kpi .icon{
    width: 42px; height: 42px; display:grid; place-items:center;
    border-radius:10px; background: rgba(255,255,255,.08); color:#fff;
  }
  .kpi .value{ font-size:1.5rem; font-weight:800; }
  .kpi .label{ color: var(--muted); font-weight:600; }

  /* Table shell (synced to background) */
  .table-shell{
    border-radius:14px; overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    background: linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.035));
    box-shadow: inset 0 1px 0 rgba(255,255,255,.04);
  }
  .table-sync{
    --bs-table-bg: transparent; margin:0; color:var(--text);
    border-collapse:separate; border-spacing:0;
  }
  .table-sync thead th{
    background: linear-gradient(180deg, rgba(255,255,255,.09), rgba(255,255,255,.06))!important;
    color:#dfe5f3; font-weight:700; padding:.85rem .9rem; border:0;
    border-bottom:1px solid rgba(255,255,255,.1);
  }
  .table-sync tbody td{ padding:.8rem .9rem; border-top:1px solid rgba(255,255,255,.06); }
  .table-sync tbody tr:nth-child(odd){ background: rgba(255,255,255,.02); }
  .table-sync tbody tr:nth-child(even){ background: rgba(255,255,255,.015); }
  .table-sync tbody tr:hover{ background: var(--row-hover); }

  /* Row hover halo */
  .row-focus{ position:relative; isolation:isolate; }
  .row-focus::after{
    content:""; position:absolute; inset:-2px; border-radius:12px;
    background: radial-gradient(40rem 8rem at 50% 0%, rgba(124,58,237,.35), transparent 60%);
    opacity:0; transition:opacity .2s ease; z-index:-1;
  }
  .row-focus:hover::after{ opacity:.25; }

  /* Status chips */
  .chip{ border-radius:10px; padding:.35rem .6rem; font-weight:700; font-size:.8rem; display:inline-block; }
  .st-open{ background: rgba(239,68,68,.22); color:#ffd1d1; }
  .st-progress{ background: rgba(245,158,11,.22); color:#ffe3a3; }
  .st-resolved{ background: rgba(34,197,94,.22); color:#cbf7d7; }

  /* Action pill */
  .pill{
    display:inline-flex; align-items:center; gap:.45rem; padding:.48rem .8rem;
    border-radius:999px; font-weight:700; font-size:.86rem;
    border:1px solid rgba(255,255,255,.16);
    background: rgba(255,255,255,.05); color:#f4f7ff;
    transition: transform .15s ease, box-shadow .25s ease, background .2s ease, border-color .2s ease;
  }
  .pill:hover{ transform: translateY(-1px); background: rgba(60,100,185,.2); border-color: rgba(91,140,255,.45); box-shadow: 0 12px 26px rgba(0,0,0,.28); text-decoration:none; }

  .muted{ color: var(--muted); }

  /* Mobile tweaks */
  @media (max-width: 991.98px){
    .kpi .value{ font-size:1.3rem; }
    .table-sync thead{ display:none; }
    .table-sync tbody tr{ display:block; padding:.75rem .9rem; border-bottom:1px solid rgba(255,255,255,.08); }
    .table-sync tbody td{ display:flex; justify-content:space-between; border:0; padding:.45rem 0; }
    .table-sync tbody td::before{ content:attr(data-label); color:#a9b2c9; font-weight:600; margin-right:1rem; }
  }
</style>

<div class="admin-page">
  <div class="container frame p-3 p-md-4">

    <!-- Header -->
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
      <h3 class="m-0 title">Admin Dashboard</h3>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.complaints') }}" class="btn btn-primary">
          <i class="bi bi-clipboard-check me-1"></i> Manage Complaints
        </a>
        <a href="{{ route('complaints.create') }}" class="btn btn-outline">
          <i class="bi bi-plus-lg me-1"></i> New Complaint
        </a>
      </div>
    </div>

    <!-- KPIs -->
    <div class="row g-3 g-md-4 mb-4">
      <div class="col-6 col-md-3">
        <div class="card-glass p-3 p-md-4 kpi">
          <div class="d-flex align-items-center gap-3">
            <div class="icon"><i class="bi bi-collection"></i></div>
            <div>
              <div class="value">{{ $metrics['total'] ?? '—' }}</div>
              <div class="label">Total</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-glass p-3 p-md-4 kpi">
          <div class="d-flex align-items-center gap-3">
            <div class="icon"><i class="bi bi-exclamation-octagon"></i></div>
            <div>
              <div class="value">{{ $metrics['open'] ?? '—' }}</div>
              <div class="label">Open</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-glass p-3 p-md-4 kpi">
          <div class="d-flex align-items-center gap-3">
            <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
            <div>
              <div class="value">{{ $metrics['in_progress'] ?? '—' }}</div>
              <div class="label">In Progress</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-glass p-3 p-md-4 kpi">
          <div class="d-flex align-items-center gap-3">
            <div class="icon"><i class="bi bi-check2-circle"></i></div>
            <div>
              <div class="value">{{ $metrics['resolved'] ?? '—' }}</div>
              <div class="label">Resolved</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main row: Recent + Snapshot -->
    <div class="row g-3 g-md-4">
      <!-- Recent complaints -->
      <div class="col-lg-8">
        <div class="card-glass p-3 p-md-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Recent Complaints</h5>
            <a href="{{ route('admin.complaints') }}" class="btn-link-muted">View all</a>
          </div>

          @if(empty($recentComplaints) || count($recentComplaints) === 0)
            <div class="text-white-50 py-2">No recent complaints.</div>
          @else
            <div class="table-shell">
              <table class="table table-sync align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th class="text-start">Subject</th>
                    <th>User</th>
                    <th>Updated</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentComplaints as $c)
                    @php
                      $status = strtolower($c->status ?? '');
                      $chip = match($status){
                        'open' => 'chip st-open',
                        'in progress', 'in_progress' => 'chip st-progress',
                        'resolved' => 'chip st-resolved',
                        default => 'chip'
                      };
                    @endphp
                    <tr class="row-focus">
                      <td data-label="ID">#{{ $c->id }}</td>
                      <td class="text-white text-start" data-label="Subject">{{ Str::limit($c->subject ?? $c->title, 40) }}</td>
                      <td class="muted" data-label="User">{{ $c->user->name ?? '—' }}</td>
                      <td class="muted" data-label="Updated">{{ $c->updated_at?->diffForHumans() ?? '—' }}</td>
                      <td data-label="Status"><span class="{{ $chip }}">{{ ucfirst($status) ?: '—' }}</span></td>
                      <td class="text-end" data-label="Action">
                        <a href="{{ route('admin.complaints.show', $c->id) }}" class="pill">
                          <i class="bi bi-eye"></i> Details
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>

      <!-- Snapshot / Quick actions -->
      <div class="col-lg-4">
        <div class="card-glass p-3 p-md-4 mb-3">
          <h5 class="m-0 mb-3">Today’s Snapshot</h5>

          <div class="d-flex justify-content-between muted mb-1">
            <span>Avg. Resolution Time</span><span>{{ $snapshot['avg_resolution'] ?? '—' }}</span>
          </div>
          <div class="d-flex justify-content-between muted mb-1">
            <span>Overdue Complaints</span><span>{{ $snapshot['overdue'] ?? '—' }}</span>
          </div>
          <div class="d-flex justify-content-between muted mb-2">
            <span>New Today</span><span>{{ $snapshot['new_today'] ?? '—' }}</span>
          </div>

          @php $clear = $snapshot['weekly_clearance_pct'] ?? 0; @endphp
          <small class="muted d-block mb-1">Weekly Clearance</small>
          <div class="progress" style="height:6px; border-radius:999px; background:rgba(255,255,255,.08);">
            <div class="progress-bar" style="width:{{ $clear }}%; background-image:linear-gradient(90deg,var(--pri-1),var(--pri-2));"></div>
          </div>
          <small class="muted">{{ $clear }}%</small>
        </div>

        <div class="card-glass p-3 p-md-4">
          <h6 class="m-0 mb-3">Quick Actions</h6>
          <div class="d-grid gap-2">
            <a href="{{ route('admin.complaints') }}" class="btn btn-primary">
              <i class="bi bi-wrench-adjustable me-1"></i> Update Status
            </a>
            <a href="{{ route('complaints.create') }}" class="btn btn-outline">
              <i class="bi bi-pencil-square me-1"></i> File New Complaint
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
