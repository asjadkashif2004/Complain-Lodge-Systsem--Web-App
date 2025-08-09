<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Layout Background */
        body {
            background-color: #f8f9fa;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(90deg, #0d6efd, #003c8f);
            box-shadow: 0 4px 8px rgba(0,0,0,0.25);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color: white !important;
            letter-spacing: 0.5px;
        }
        .nav-link {
            color: #f8f9fa !important;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #ffd700 !important;
        }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            background-color: #0d6efd;
            border: none;
            border-radius: 8px;
            overflow: hidden;
        }
        .dropdown-item {
            color: white;
            transition: 0.2s;
        }
        .dropdown-item:hover {
            background-color: #0056b3;
            color: #ffd700;
        }

        /* Page Header */
        header.page-header {
            background-color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            border-radius: 6px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-vh-100 d-flex flex-column">
        
        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="page-header container py-3 px-4">
                {{ $header }}
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="flex-grow-1 container my-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
