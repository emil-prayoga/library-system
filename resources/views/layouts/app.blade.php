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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>

        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
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
            --color-border: #e5e7eb;
            --color-border-light: #f3f4f6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius: 8px;
            --radius-lg: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
                overflow-y: scroll;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            html {
                scrollbar-gutter: stable;
            }

           

            .btn {
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                border: none;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .btn-primary {
                background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
                color: white;
            }

            .btn-primary:hover {
                opacity: 0.9;
            }

            .btn-secondary {
                background: var(--color-bg);
                color: var(--color-text);
                border: 1px solid var(--color-border);
            }

            .btn-secondary:hover {
                border-color: var(--color-primary);
                color: var(--color-primary);
            }

            .btn-danger {
                background-color: var(--color-danger);
                color: white;
            }

            .btn-danger:hover {
                opacity: 0.9;
            }

            .card {
                background-color: var(--color-bg-secondary);
                border: 1px solid var(--color-border);
                border-radius: 0.5rem;
                padding: 1.5rem;
            }

            .form-control {
                background-color: var(--color-bg);
                border: 1px solid var(--color-border);
                border-radius: 0.375rem;
                padding: 0.75rem;
                color: var(--color-text);
                font-family: inherit;
            }

            .form-control:focus {
                outline: none;
                border-color: var(--color-primary);
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

            .text-center {
                text-align: center;
            }

            .text-danger {
                color: var(--color-danger);
            }

            .text-success {
                color: var(--color-success);
            }

            .text-light {
                color: var(--color-text-light);
            }

            .mb-4 {
                margin-bottom: 1rem;
            }

            .mt-4 {
                margin-top: 1rem;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background-color: var(--color-bg-secondary);
            }

            table th {
                background-color: rgba(102, 126, 234, 0.1);
                padding: 1rem;
                text-align: left;
                color: var(--color-primary);
                font-weight: 600;
                border-bottom: 2px solid var(--color-border);
            }

            table td {
                padding: 1rem;
                border-bottom: 1px solid var(--color-border);
                color: var(--color-text);
            }

            table tr:hover {
                background-color: rgba(102, 126, 234, 0.05);
            }

            .min-h-screen {
                min-height: 100vh;
            }

            .main-wrapper {
    flex: 1;
    width: 100%;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

.container-wide {
    max-width: 100%;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}



    input {
        font-family: inherit;
        transition: all 0.3s ease;
    }

     input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
            
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header style="background-color: var(--color-bg-secondary); border-bottom: 1px solid var(--color-border);">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 1.5rem;">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
           <main class="main-wrapper">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('components.footer')
        </div>

        <script>
            // Modal functions
            function openDetailModal(id) {
                const modal = document.getElementById('detailModal-' + id);
                if (modal) {
                    modal.style.display = 'flex';
                }
            }

            function closeDetailModal(id) {
                const modal = document.getElementById('detailModal-' + id);
                if (modal) {
                    modal.style.display = 'none';
                }
            }

            // Close modal when clicking outside
            document.addEventListener('click', function(event) {
                if (event.target.id && event.target.id.startsWith('detailModal-')) {
                    event.target.style.display = 'none';
                }
            });
        </script>
    </body>
</html>
