@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  :root{
    --bg-start:#0f172a; --bg-end:#111827;
    --glass-bg:rgba(255,255,255,.06); --glass-brd:rgba(255,255,255,.14);
    --text:#e5e7eb; --muted:#9ca3af;
    --primary-1:#5b8cff; --primary-2:#7c3aed;
  }

  /* Full page background */
  body {
    background:
      radial-gradient(65rem 65rem at 10% -50%, rgba(124,58,237,.22), transparent 60%),
      radial-gradient(55rem 55rem at 110% 0%, rgba(34,211,238,.14), transparent 60%),
      linear-gradient(180deg, var(--bg-start), var(--bg-end));
    color: var(--text);
    font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
    min-height: 100vh;
  }

  /* Glass card */
  .card-glass{
    max-width: 760px; margin: 4rem auto;
    background: var(--glass-bg);
    border: 1px solid var(--glass-brd);
    border-radius: 18px;
    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 18px 40px rgba(0,0,0,.45), inset 0 1px 0 rgba(255,255,255,.05);
    overflow: hidden;
  }
  .card-header-glass{
    background: linear-gradient(90deg, rgba(124,58,237,.25), rgba(91,140,255,.25));
    border-bottom: 1px solid rgba(255,255,255,.10);
    color:#fff;
    padding: 1rem 1.25rem;
  }

  /* Labels */
  .form-label{ color:#cbd5e1; font-weight:700; }

  /* Inputs & Textarea (force dark bg + light text in all states) */
  .form-control{
    background: rgba(255,255,255,.06) !important;
    color: #e5e7eb !important;
    border:1px solid rgba(255,255,255,.14) !important;
    border-radius: 12px;
    padding:.9rem .95rem; font-size:1rem;
  }
  .form-control::placeholder{ color:#94a3b8 !important; }
  .form-control:focus{
    background: rgba(255,255,255,.06) !important;
    color:#fff !important;
    border-color: rgba(124,58,237,.6) !important;
    box-shadow: 0 0 0 4px rgba(124,58,237,.18) !important;
    outline: none !important;
  }
  textarea.form-control{ min-height: 160px; resize: vertical; }

  /* Validation */
  .is-invalid{
    border-color: rgba(239,68,68,.7) !important;
    box-shadow: 0 0 0 4px rgba(239,68,68,.15) !important;
  }
  .invalid-feedback{ color:#fecaca; }

  /* Buttons */
  .btn-primary{
    width:100%;
    border: none; border-radius: 12px; font-weight: 800;
    background-image: linear-gradient(90deg, var(--primary-2), var(--primary-1));
    box-shadow: 0 12px 28px rgba(91,140,255,.35);
    padding:.9rem 1.1rem; color:#fff;
    transition: transform .18s ease, box-shadow .25s ease, filter .2s ease;
  }
  .btn-primary:hover{ transform: translateY(-1px); box-shadow:0 18px 38px rgba(91,140,255,.5); filter:brightness(1.03) }

  .btn-outline{
    display:inline-flex; align-items:center; gap:.4rem;
    background: transparent; color: var(--text); border-radius: 12px; font-weight: 600;
    border: 1px solid rgba(255,255,255,.22); padding:.65rem 1rem;
  }
  .btn-outline:hover{ background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.32); color:#fff; }

  /* Helper */
  .helper{ color: var(--muted); font-size:.9rem; }
</style>

<div class="container">
  <div class="card-glass">
    <div class="card-header-glass d-flex justify-content-between align-items-center">
      <h4 class="mb-0 d-flex align-items-center gap-2">
        <i class="bi bi-pencil-square"></i> Lodge a Complaint
      </h4>
      <a href="{{ route('dashboard') }}" class="btn btn-outline">
        <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
      </a>
    </div>

    <div class="p-4 p-md-5">
      @if(session('status'))
        <div class="alert py-2 px-3 mb-4" style="background:rgba(34,197,94,.15); border:1px solid rgba(34,197,94,.35); color:#d1fae5; border-radius:12px;">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('complaints.store') }}" novalidate>
        @csrf

        <!-- Title -->
        <div class="mb-4">
          <label for="title" class="form-label">Complaint Title</label>
          <input
            type="text"
            id="title"
            name="title"
            class="form-control @error('title') is-invalid @enderror"
            placeholder="e.g., Internet not working"
            value="{{ old('title') }}"
            required>
          @error('title')
            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
          @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea
            id="description"
            name="description"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Describe the issue clearly, include room/area and timing..." required>{{ old('description') }}</textarea>
          <div class="d-flex justify-content-between mt-2 helper">
            <span><i class="bi bi-info-circle"></i> Be specific for faster resolution.</span>
            <span id="charCount">0 / 1000</span>
          </div>
          @error('description')
            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
          @enderror
        </div>

        <!-- Submit -->
        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Submit Complaint</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Live character counter
  (function(){
    const ta = document.getElementById('description');
    const cc = document.getElementById('charCount');
    if(ta && cc){
      const limit = 1000;
      const update = () => { cc.textContent = `${ta.value.length} / ${limit}`; };
      ta.addEventListener('input', update); update();
    }
  })();
</script>
@endsection
