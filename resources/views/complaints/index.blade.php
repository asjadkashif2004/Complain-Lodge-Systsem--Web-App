@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --bg-start: #0f172a;
        --bg-end: #111827;
        --glass-bg: rgba(255,255,255,0.06);
        --glass-brd: rgba(255,255,255,0.14);
        --text: #e5e7eb;
        --muted: #a3a3a3;
        --primary-1: #5b8cff;
        --primary-2: #7c3aed;
    }

    html, body {
        height: 100%;
        margin: 0;
        background:
            radial-gradient(70rem 70rem at 10% -50%, rgba(124,58,237,.22), transparent 60%),
            radial-gradient(60rem 60rem at 110% 0%, rgba(34,211,238,.14), transparent 60%),
            linear-gradient(180deg, var(--bg-start), var(--bg-end));
        color: var(--text);
    }

    .complaints-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background: var(--glass-bg);
        border: 1px solid var(--glass-brd);
        border-radius: 16px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 12px 30px rgba(0,0,0,.35);
    }

    h2 {
        font-weight: 800;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    /* Lodge button with original animation but synced color */
    .lodge-btn-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1.5rem;
    }

    .lodge-btn {
        display: flex;
        align-items: center;
        font-weight: 500;
        font-size: 17px;
        padding: 0.8em 1.3em 0.8em 0.9em;
        color: white;
        background: linear-gradient(90deg, var(--primary-2), var(--primary-1));
        border-radius: 14px;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(91,140,255,.35);
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .lodge-btn svg {
        margin-right: 3px;
        transform: rotate(30deg);
        transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
    }

    .lodge-btn span {
        transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
    }

    .lodge-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(91,140,255,.5);
    }

    .lodge-btn:hover svg {
        transform: translateX(5px) rotate(90deg);
    }

    .lodge-btn:hover span {
        transform: translateX(7px);
    }

    /* Table */
    .table-glass {
        --bs-table-bg: transparent;
        color: var(--text);
    }

    .table-glass thead th {
        background: rgba(255,255,255,0.06);
        color: #cbd5e1;
        font-weight: 700;
        border-color: rgba(255,255,255,0.08);
    }

    .table-glass tbody td {
        border-color: rgba(255,255,255,0.06);
        color: var(--text);
    }

    .table-glass tbody tr:hover {
        background: rgba(255,255,255,0.04);
    }

    /* Status badges */
    .status-badge {
        padding: 0.35rem 0.8rem;
        font-size: 0.85rem;
        font-weight: 700;
        border-radius: 999px;
    }

    .status-pending { background: rgba(245,158,11,.18); color: #fcd34d; }
    .status-resolved { background: rgba(34,197,94,.18); color: #bbf7d0; }
    .status-in-progress { background: rgba(59,130,246,.18); color: #bfdbfe; }

</style>

<div class="complaints-container">
    <h2>My Complaints</h2>

    <div class="lodge-btn-wrapper">
        <a href="{{ route('complaints.create') }}" class="lodge-btn">
            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path
                    d="M5 13c0-5.088 2.903-9.436 7-11.182C16.097 3.564 19 7.912 19 13c0 .823-.076 1.626-.22 2.403l1.94 1.832a.5.5 0 0 1 .095.603l-2.495 4.575a.5.5 0 0 1-.793.114l-2.234-2.234a1 1 0 0 0-.707-.293H9.414a1 1 0 0 0-.707.293l-2.234 2.234a.5.5 0 0 1-.793-.114l-2.495-4.575a.5.5 0 0 1 .095-.603l1.94-1.832C5.077 14.626 5 13.823 5 13zm1.476 6.696l.817-.817A3 3 0 0 1 9.414 18h5.172a3 3 0 0 1 2.121.879l.817.817.982-1.8-1.1-1.04a2 2 0 0 1-.593-1.82c.124-.664.187-1.345.187-2.036 0-3.87-1.995-7.3-5-8.96C8.995 5.7 7 9.13 7 13c0 .691.063 1.372.187 2.037a2 2 0 0 1-.593 1.82l-1.1 1.039.982 1.8zM12 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                    fill="currentColor"></path>
            </svg>
            <span>Lodge Complaint</span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-glass align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $complaint)
                    @php $status = strtolower($complaint->status); @endphp
                    <tr>
                        <td>{{ $complaint->title }}</td>
                        <td>{{ $complaint->description }}</td>
                        <td>
                            <span class="status-badge 
                                {{ $status == 'pending' ? 'status-pending' : 
                                ($status == 'resolved' ? 'status-resolved' : 
                                ($status == 'in progress' ? 'status-in-progress' : '')) }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">No complaints lodged yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
