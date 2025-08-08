@extends('layouts.app')

@section('content')
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #e3f2fd, #ffffff);
        font-family: 'Segoe UI', sans-serif;
    }

    .complaint-form-container {
        max-width: 700px;
        margin: 70px auto;
        background: #ffffff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.1);
        border-left: 8px solid #3498db;
    }

    .complaint-form-container h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-label {
        font-weight: 600;
        color: #34495e;
    }

    .form-control {
        border-radius: 10px;
        padding: 14px;
        border: 1px solid #ccc;
        transition: 0.3s ease-in-out;
        font-size: 15px;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        font-weight: bold;
        font-size: 16px;
        border-radius: 10px;
        background: linear-gradient(to right, #3498db, #2c80b4);
        color: white;
        border: none;
        transition: background 0.4s ease;
        margin-bottom: 20px;
    }

    .btn-submit:hover {
        background: linear-gradient(to right, #2c80b4, #1e6a9e);
    }

    .btn-dashboard {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 8px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-dashboard:hover {
        background-color: #5a6268;
    }

    @media (max-width: 768px) {
        .complaint-form-container {
            padding: 30px 20px;
            margin: 30px 15px;
        }
    }
</style>

<div class="container">
    <div class="complaint-form-container">
        <h2><i class="bi bi-pencil-square me-2"></i> Lodge a Complaint</h2>
        <form method="POST" action="{{ route('complaints.store') }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="form-label">Complaint Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter a brief title" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Describe the issue clearly..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">Submit Complaint</button>

            <div class="text-center mt-3">
                <a href="{{ route('dashboard') }}" class="btn-dashboard">
                    <i class="bi bi-arrow-left-circle me-1"></i> Back to Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
