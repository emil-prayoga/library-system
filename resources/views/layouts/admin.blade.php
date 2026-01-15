<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Admin Panel' }} - Library System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        :root {
            --color-primary: #667eea;
            --color-secondary: #764ba2;
            --color-danger: #ef4444;
            --color-success: #10b981;
            --color-bg: #ffffffff;
            --color-bg-secondary: #ffffffff;
            --color-text: #000000ff;
            --color-text-light: #696969ff;
            --color-border: #d8d8d8ff;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.6;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 2rem 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding-bottom: 10rem;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #efefefff;
            border-radius: 3px;
        }

        .sidebar-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--color-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-logo {
            font-size: 1.75rem;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex: 1;
            margin-bottom: 1rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            color: var(--color-text);
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .sidebar-nav-item:hover {
            background-color: rgba(102, 126, 234, 0.1);
            color: var(--color-primary);
        }

        .sidebar-nav-item.active {
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            font-weight: 600;
        }

        .sidebar-nav-icon {
            font-size: 1.25rem;
            width: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-footer {
            position: static;
            bottom: auto;
            left: auto;
            right: auto;
            margin-top: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            flex-shrink: 0;
        }

      

        /* Main Content */
        .admin-content {
            margin-left: 280px;
            flex: 1;
            padding: 2rem;
        }

        .admin-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--color-border);
        }

        .admin-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between; /* judul kiri - tombol kanan */

        }

        .admin-header-top h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #1f2937;
        }

        .admin-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }

        /* tombol */
        .btn-add {
            padding: 0.75rem 1.5rem;
            background: linear-gradient( 90deg, var(--color-primary),var(--color-secondary));
            border-radius: 0.375rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            opacity: 0.95;
        }

        .btn-plus {
            font-size: 1.25rem;
            font-weight: bold;
        }

       

        .admin-header h1 {
            font-size: 2rem;
            font-weight: bold;
            color: var(--color-text);
            margin-bottom: 0.5rem;
        }

        .admin-header p {
            color: var(--color-text-light);
            font-size: 0.95rem;
        }

        .admin-header > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        table {
            font-size: 14px;
        }

        table th {
            background-color: rgba(102, 126, 234, 0.1);
            border-bottom: 2px solid var(--color-border);
        }

        table td {
            border-bottom: 1px solid var(--color-border);
        }

        button, input, select {
            font-family: inherit;
        }

       

        .sidebar-toggle-btn {
            display: none;
            width: auto;
            flex-shrink: 0;
            padding: 0.5rem 0.75rem;
            min-width: fit-content;
        }

        .btn-logout {
            all: unset;
            width: 100%;
            cursor: pointer;
}

        .btn-logout-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: var(--color-text);
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        /* Hover hanya kena isi, bukan parent sidebar */
        .btn-logout-content:hover {
                 background-color: rgba(102, 126, 234, 0.1);
            color: var(--color-primary);
        }

        .btn-logout-content:hover i {
            color: var(--color-primary);
        }

        .btn-logout-icon {
            font-size: 1.25rem;
            width: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
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

        @media (max-width: 768px) {

        .sidebar-toggle-btn {
                display: block;
            }
            .admin-sidebar {
                width: 250px;
                padding: 1.5rem 0.75rem;
                z-index: 200;
            }

            .admin-content {
                margin-left: 250px;
                padding: 1.5rem;
            }

            .admin-header h1 {
                font-size: 1.5rem;
            }

            .sidebar-nav-item span:last-child {
                display: inline;
            }

            .sidebar-toggle-btn {
                display: none;
            }


        }

        @media (max-width: 640px) or (max-height: 600px) {
            .admin-sidebar {
                position: fixed;
                width: 50%;
                max-width: 280px;
                height: 100vh;
                left: 0;
                top: 0;
                transform: translateX(-100%);
                padding: 1rem 0.75rem;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
                z-index: 300;
                transition: transform 0.3s ease;
                display: flex;
                flex-direction: column;
                overflow-y: auto;
            }

            .admin-sidebar > .sidebar-toggle-btn {
                width: auto;
                min-width: fit-content;
                padding: 0.4rem 0.6rem;
                font-size: 1rem;
                margin-bottom: 1rem;
                align-self: flex-start;
            }

            .admin-container.sidebar-open .admin-sidebar {
                transform: translateX(0);
            }

            .admin-container::before {
                content: '';
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0);
                z-index: 99;
                pointer-events: none;
                transition: background 0.3s ease;
            }

            .admin-container.sidebar-open::before {
                background: rgba(0, 0, 0, 0.4);
                pointer-events: all;
            }

            .admin-content {
                margin-left: 0;
                padding: 1rem;
                width: 100%;
                flex: 1;
            }

            .admin-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 1rem;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
            }

            .admin-header > div {
                display: flex;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .admin-header h1 {
                font-size: 1.25rem;
                margin-bottom: 0;
            }

            .admin-header p {
                display: block;
                font-size: 0.85rem;
                margin-top: 0.25rem;
            }

            .sidebar-toggle-btn {
                display: block;
                background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
                color: white;
                border: none;
                font-size: 1.25rem;
                cursor: pointer;
                padding: 0.5rem 0.75rem;
                border-radius: 0.375rem;
                margin-bottom: 0;
                flex-shrink: 0;
                width: auto;
                min-width: fit-content;
            }

            .sidebar-toggle-btn:hover {
                opacity: 0.9;
            }

            .sidebar-title {
                font-size: 1.1rem;
            }

            .sidebar-nav-item {
                padding: 0.6rem 0.75rem;
                font-size: 0.85rem;
            }

            table {
                font-size: 0.85rem;
                width: 100%;
            }

            table th,
            table td {
                padding: 0.5rem !important;
            }

            
        }

        @media (max-width: 480px) {
            .admin-sidebar {
                width: 70%;
                max-width: 320px;
            }

            .admin-content {
                padding: 0.75rem;
            }

            .admin-header h1 {
                font-size: 1rem;
            }

            .admin-header {
                gap: 0.5rem;
            }

            table {
                font-size: 0.75rem;
            }

            button, a {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .sidebar-toggle-btn {
                font-size: 1rem;
                padding: 0.4rem 0.6rem;
            }

            
    </style>
</head>
<body>
    <div class="admin-container" id="adminContainer">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <button class="sidebar-toggle-btn" onclick="closeSidebar()"><i class="fas fa-times"></i></button>
            
            <div class="sidebar-header">
                <div class="sidebar-title">
                    <span class="sidebar-logo"><i class="fas fa-book"></i></span>
                    <span>Admin Panel</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dashboard', 'admin.view-as-user', 'admin.borrowings.show') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-chart-line"></i></span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.books.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-book-open"></i></span>
                    <span>Books</span>
                </a>

                <a href="{{ route('admin.returns.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.returns.*') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-undo"></i></span>
                    <span>Pengembalian</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-folder"></i></span>
                    <span>Categories</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-users"></i></span>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.messages.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-envelope"></i></span>
                    <span>Messages</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" onclick="closeSidebar()">
                    <span class="sidebar-nav-icon"><i class="fas fa-globe"></i></span>
                    <span>View Website</span>
                </a>


                <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
                @csrf
                <button type="submit" class="btn-logout" onclick="closeSidebar()">
                    <div class="btn-logout-content">
                        <span class="btn-logout-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span>Logout</span>
                    </div>
                </button>
            </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; width: fit-content;">
                <button class="sidebar-toggle-btn" id="sidebarToggle" onclick="toggleSidebar()" style="display: none;"><i class="fas fa-bars"></i></button>
            </div>
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const container = document.getElementById('adminContainer');
            container.classList.toggle('sidebar-open');
        }

        function closeSidebar() {
            const container = document.getElementById('adminContainer');
            container.classList.remove('sidebar-open');
        }

        // Show/hide sidebar toggle button based on screen size
        function updateSidebarToggle() {
            const toggleBtn = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 640) {
                toggleBtn.style.display = 'block';
            } else {
                toggleBtn.style.display = 'none';
                closeSidebar();
            }
        }

        window.addEventListener('resize', updateSidebarToggle);
        document.addEventListener('DOMContentLoaded', updateSidebarToggle);
        updateSidebarToggle();

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const container = document.getElementById('adminContainer');
            
            if (window.innerWidth <= 640 && 
                !sidebar.contains(e.target) && 
                !toggleBtn.contains(e.target) && 
                container.classList.contains('sidebar-open')) {
                closeSidebar();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
