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
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link rel="stylesheet" href="resources/css/app.css">
        <style>
            :root {
                --color-primary: #6366f1;
                --color-primary-light: #818cf8;
                --color-primary-dark: #4f46e5;
                --color-secondary: #8b5cf6;
                --color-success: #10b981;
                --color-warning: #f59e0b;
                --color-danger: #ef4444;
                --color-info: #3b82f6;
                --color-text: #1f2937;
                --color-text-light: #6b7280;
                --color-bg: #ffffff;
                --color-bg-light: #f9fafb;
                --color-bg-secondary: #ffffff;
                --color-border: #e5e7eb;
                --color-border-light: #f3f4f6;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                background-color: var(--color-bg);
                color: var(--color-text);
                line-height: 1.6;
            }

            .card {
                background-color: var(--color-bg-secondary);
                border: 1px solid var(--color-border);
                border-radius: 0.5rem;
                padding: 2rem;
            }

            .form-control {
                background-color: var(--color-bg);
                border: 1px solid var(--color-border);
                border-radius: 0.375rem;
                padding: 0.75rem;
                color: var(--color-text);
                font-family: inherit;
                width: 100%;
            }

            .form-control:focus {
                outline: none;
                border-color: var(--color-primary);
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .form-control.is-invalid {
                border-color: var(--color-danger);
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                color: var(--color-text-light);
                font-size: 0.9rem;
                font-weight: 500;
            }

            .text-danger {
                color: var(--color-danger);
                font-size: 0.85rem;
                margin-top: 0.25rem;
                display: block;
            }

            .text-sm {
                font-size: 0.875rem;
            }

            .text-center {
                text-align: center;
            }

            .text-light {
                color: var(--color-text-light);
            }

            .text-primary {
                color: var(--color-primary);
            }

            .btn {
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                border: none;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
            }

            .btn-primary {
                background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
                color: white;
                width: 100%;
            }

            .btn-primary:hover {
                opacity: 0.9;
            }

            .alert {
                padding: 1rem;
                border-radius: 0.375rem;
                margin-bottom: 1rem;
            }

            .alert-success {
                background-color: rgba(16, 185, 129, 0.1);
                border: 1px solid rgba(16, 185, 129, 0.3);
                color: #86efac;
            }

            .alert-error {
                background-color: rgba(239, 68, 68, 0.1);
                border: 1px solid rgba(239, 68, 68, 0.3);
                color: #fca5a5;
            }

            .alert-info {
                background-color: rgba(59, 130, 246, 0.1);
                border: 1px solid rgba(59, 130, 246, 0.3);
                color: #60a5fa;
            }

            .mb-4 {
                margin-bottom: 1rem;
            }

            .mt-2 {
                margin-top: 0.5rem;
            }

            .pt-4 {
                padding-top: 1rem;
            }

            .w-full {
                width: 100%;
            }

            .is-invalid {
                border-color: var(--color-danger) !important;
            }

            a {
                color: var(--color-primary);
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            input[type="checkbox"] {
                cursor: pointer;
            }

            label {
                cursor: pointer;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div style="min-height: 100vh;">
            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
