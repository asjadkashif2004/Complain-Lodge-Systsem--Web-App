@extends('layouts.app')

@section('content')
<!-- Bootstrap CDN (if not already included in app layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .complaints-container {
        max-width: 950px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }

    .complaints-container h2 {
        margin-bottom: 30px;
        color: #1a1a1a;
        font-weight: 700;
        text-align: center;
    }

    .lodge-btn-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .lodge-btn {
        display: flex;
        align-items: center;
        font-family: inherit;
        cursor: pointer;
        font-weight: 500;
        font-size: 17px;
        padding: 0.8em 1.3em 0.8em 0.9em;
        color: white;
        background: linear-gradient(to right, #0f0c29, #302b63, #24243e);
        border: none;
        letter-spacing: 0.05em;
        border-radius: 16px;
        text-decoration: none;
    }

    .lodge-btn svg {
        margin-right: 3px;
        transform: rotate(30deg);
        transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
    }

    .lodge-btn span {
        transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
    }

    .lodge-btn:hover svg {
        transform: translateX(5px) rotate(90deg);
    }

    .lodge-btn:hover span {
        transform: translateX(7px);
    }

    table {
        width: 100%;
        font-size: 16px;
    }

    thead {
        background-color: #f0f0f0;
    }

    th, td {
        padding: 16px 14px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
        vertical-align: middle;
    }

    tr:hover {
        background-color: #fafafa;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .status-pending {
        background-color: #ffe9c9;
        color: #aa6708;
    }

    .status-resolved {
        background-color: #c9f7d0;
        color: #1e7040;
    }

    .status-in-progress {
        background-color: #cce5ff;
        color: #0056b3;
    }
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

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->title }}</td>
                    <td>{{ $complaint->description }}</td>
                    <td>
                        @php $status = strtolower($complaint->status); @endphp
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
                    <td colspan="3" style="text-align: center; color: #777;">No complaints lodged yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
