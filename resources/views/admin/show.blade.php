<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complaint Details</title>

    {{-- Bootstrap 5.3 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff, #e6f0ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .card-header {
            background: linear-gradient(45deg, #4e73df, #1cc88a);
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            background-color: #ffffff;
            border-radius: 0 0 15px 15px;
        }
        .label-title {
            font-weight: 600;
            color: #374785;
        }
        .description-box {
            background-color: #f8f9fc;
            border-left: 4px solid #4e73df;
        }
        .btn-back {
            background-color: #4e73df;
            color: white;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background-color: #2e59d9;
            color: white;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header text-white px-4 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>Complaint Details
                    </h4>
                    <a href="{{ route('admin.complaints') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="label-title">Title</h5>
                        <p class="fs-5">{{ $complaint->title }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="label-title">Filed By (User ID)</h5>
                        <p class="text-muted">{{ $complaint->user_id }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="label-title">Description</h5>
                        <div class="description-box p-3 rounded">
                            {{ $complaint->description }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="label-title">Status</h5>
                        <span class="badge fs-6 px-3 py-2
                            @if($complaint->status == 'Resolved') bg-success
                            @elseif($complaint->status == 'In Progress') bg-warning text-dark
                            @elseif($complaint->status == 'Rejected') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ $complaint->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
