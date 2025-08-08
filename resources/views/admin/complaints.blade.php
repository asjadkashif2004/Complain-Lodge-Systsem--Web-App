@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-clipboard-check me-2"></i> Manage Complaints</h4>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-gear-fill"></i> Admin Options
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bar-chart"></i> View Reports</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-arrow-down"></i> Export Data</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-sliders"></i> Settings</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($complaints->isEmpty())
                        <div class="alert alert-info text-center">No complaints found.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($complaints as $index => $complaint)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $complaint->user_id }}</td>
                                            <td>{{ $complaint->title }}</td>
                                            <td class="text-start">{{ Str::limit($complaint->description, 50) }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($complaint->status == 'Resolved') bg-success
                                                    @elseif($complaint->status == 'In Progress') bg-warning text-dark
                                                    @elseif($complaint->status == 'Rejected') bg-danger
                                                    @else bg-secondary
                                                    @endif">
                                                    {{ $complaint->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <!-- View Button -->
                                                    <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-outline-info btn-sm">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>

                                                    <!-- Update Status -->
                                                    <form method="POST" action="{{ route('admin.complaints.updateStatus', $complaint->id) }}">
                                                        @csrf
                                                        <div class="input-group input-group-sm">
                                                            <select name="status" class="form-select" required>
                                                                <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                                <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                                                <option value="Rejected" {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="bi bi-check2-circle"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
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
    </div>
</div>
@endsection
