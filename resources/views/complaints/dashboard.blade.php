@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  :root{
    /* palette */
    --bg-1:#0d1323; --bg-2:#0a1020; --bg-3:#070c18;
    --glass:rgba(255,255,255,.055); --glass-brd:rgba(255,255,255,.12);
    --text:#ecf0f8; --muted:#a8b2c6;
    --pri-1:#7c3aed; --pri-2:#5b8cff; --accent:#2e4f9a;
    --row-hover:rgba(60,100,185,.14);
  }

  /* ---------- page canvas (no white bands) ---------- */
  html,body{height:100%; background:var(--bg-2);}
  .page{
    min-height:100vh; position:relative; color:var(--text);
    background:
      radial-gradient(90rem 55rem at 120% -10%, rgba(124,58,237,.16), transparent 60%),
      radial-gradient(70rem 45rem at -20% 5%, rgba(34,211,238,.12), transparent 65%),
      linear-gradient(180deg, var(--bg-1), var(--bg-2) 55%, var(--bg-3));
    padding: 1.5rem 0 3.5rem;
  }
  .page::after{ /* gentle micro-grid to kill flatness */
    content:""; position:absolute; inset:0; pointer-events:none;
    background-image:
      linear-gradient(transparent 31px, rgba(255,255,255,.02) 32px),
      linear-gradient(90deg, transparent 31px, rgba(255,255,255,.02) 32px);
    background-size:32px 32px; opacity:.28;
  }

  /* nuke any stray white from parent layout */
  .page .bg-white, .page .card, .page .table, .page .alert,
  .page .list-group, .page .modal-content { background:transparent!important; color:var(--text); }

  /* frame so content doesn’t look like a floating slab */
  .frame{
    border-radius:18px; overflow:hidden; position:relative;
    background: linear-gradient(180deg, rgba(255,255,255,.035), rgba(255,255,255,.02));
    border:1px solid rgba(255,255,255,.06);
    box-shadow: 0 28px 60px rgba(0,0,0,.55);
  }

  /* ---------- headings / buttons ---------- */
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
  .btn-link-muted{ color:#cfd6e6; text-decoration:none; }
  .btn-link-muted:hover{ color:#fff; text-decoration:underline; }

  /* ---------- glass cards / KPI ---------- */
  .card-glass{
    background:var(--glass); border:1px solid var(--glass-brd);
    border-radius:14px; backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px);
    box-shadow: 0 12px 28px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.05);
    transition: transform .18s ease, box-shadow .25s ease, border-color .2s ease;
  }
  .stat:hover{ transform:translateY(-2px); border-color:rgba(124,58,237,.35); box-shadow:0 18px 38px rgba(0,0,0,.45); }
  .kpi-label{ color:#c7cfdb; font-size:.9rem; }
  .kpi-value{ font-size:1.9rem; font-weight:800; line-height:1; }

  /* ---------- table shell ---------- */
  .table-shell{
    border-radius:14px; overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    background: linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.035));
    box-shadow: inset 0 1px 0 rgba(255,255,255,.04);
  }
  .table-sync{
    --bs-table-bg: transparent; margin:0;
    color:var(--text); border-collapse:separate; border-spacing:0;
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

  /* interactive row accent (focus/hover ring) */
  .row-focus{
    position:relative; isolation:isolate;
  }
  .row-focus::after{
    content:""; position:absolute; inset:-2px; border-radius:12px;
    background: radial-gradient(40rem 8rem at 50% 0%, rgba(124,58,237,.35), transparent 60%);
    opacity:0; transition:opacity .2s ease;
    z-index:-1;
  }
  .row-focus:hover::after{ opacity:.25; }

  /* action pill */
  .pill{
    display:inline-flex; align-items:center; gap:.45rem; padding:.48rem .8rem;
    border-radius:999px; font-weight:700; font-size:.86rem;
    border:1px solid rgba(255,255,255,.16);
    background: rgba(255,255,255,.05);
    color:#f4f7ff;
    transition: transform .15s ease, box-shadow .25s ease, background .2s ease, border-color .2s ease;
  }
  .pill .bi{ font-size:1rem; opacity:.9; }
  .pill:hover{ transform:translateY(-1px); background: rgba(60,100,185,.2); border-color:rgba(91,140,255,.45);
               box-shadow:0 12px 26px rgba(0,0,0,.28); text-decoration:none; }

  /* status chips */
  .chip{ border-radius:10px; padding:.35rem .6rem; font-weight:700; font-size:.8rem; display:inline-block; }
  .c1{ background: rgba(148,163,184,.18); color:#e2e8f0; }
  .c2{ background: rgba(245,158,11,.22); color:#ffe4a1; }
  .c3{ background: rgba(34,197,94,.22); color:#cbf7d7; }
  .c4{ background: rgba(239,68,68,.22); color:#ffd1d1; }

  /* ---------- mobile stack ---------- */
  @media (max-width: 991.98px){
    .kpi-value{ font-size:1.6rem; }
    .table-sync thead{ display:none; }
    .table-sync tbody tr{ display:block; padding:.75rem .9rem; border-bottom:1px solid rgba(255,255,255,.08); }
    .table-sync tbody td{ display:flex; justify-content:space-between; border:0; padding:.45rem 0; }
    .table-sync tbody td::before{ content:attr(data-label); color:#a9b4c9; font-weight:600; margin-right:1rem; }
  }
</style>

<div class="page">
  <div class="container frame p-3 p-md-4">

    <!-- header -->
    <div class="mb-4 d-flex flex-wrap gap-3 justify-content-between align-items-center">
      <h3 class="m-0 title">Welcome, {{ $user->name }}</h3>
      <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> New Complaint
      </a>
    </div>

    <!-- kpis -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-md-3"><div class="card-glass stat p-3"><div class="kpi-label">Total</div><div class="kpi-value">{{ $stats['total'] }}</div></div></div>
      <div class="col-6 col-md-3"><div class="card-glass stat p-3"><div class="kpi-label">Pending</div><div class="kpi-value">{{ $stats['pending'] }}</div></div></div>
      <div class="col-6 col-md-3"><div class="card-glass stat p-3"><div class="kpi-label">In Progress</div><div class="kpi-value">{{ $stats['inProgress'] }}</div></div></div>
      <div class="col-6 col-md-3"><div class="card-glass stat p-3"><div class="kpi-label">Resolved</div><div class="kpi-value">{{ $stats['resolved'] }}</div></div></div>
    </div>

    <!-- table card -->
    <div class="card-glass p-3 p-md-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Recent Complaints</h5>
        <a href="{{ route('complaints.index') }}" class="btn-link-muted">View all</a>
      </div>

      @if($recent->isEmpty())
        <div class="text-white-50 py-2">No recent complaints yet.</div>
      @else
        <div class="table-shell">
          <table class="table table-sync align-middle">
            <thead>
              <tr>
                <th class="text-start">Title</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recent as $c)
                @php
                  $badge = match($c->status){
                    'Resolved' => 'c3', 'In Progress' => 'c2', 'Rejected' => 'c4', default => 'c1'
                  };
                @endphp
                <tr class="row-focus">
                  <td class="text-white text-start" data-label="Title">{{ $c->title }}</td>
                  <td data-label="Status"><span class="chip {{ $badge }}">{{ $c->status }}</span></td>
                  <td class="text-white-50" data-label="Created">{{ $c->created_at->diffForHumans() }}</td>
                  <td class="text-end" data-label="Action">
                    <a href="{{ route('complaints.index') }}" class="pill">
                      <i class="bi bi-eye"></i> View
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
</div>
@endsection
