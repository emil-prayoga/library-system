<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo/Brand -->
        <div class="navbar-brand">
            <a href="{{ route('books.index') }}" class="navbar-logo">
                <i class="fas fa-book"></i> Library
            </a>
        </div>

    
        <!-- Navigation Links -->
        <div class="navbar-menu" id="navbarMenu">
            <button class="close-menu" onclick="toggleMenu()"><i class="fas fa-times"></i></button>
            
            @php
                $isGuestMode = session()->get('guest_mode');
                $currentRoute = Route::currentRouteName();
            @endphp
            
            @if($isGuestMode)
                <!-- Guest Mode: Only About and Books -->
                @php
                    // About active jika di halaman about, atau sebagai default saat pertama masuk
                    $guestAboutActive = $currentRoute === 'guest.about' || 
                        (!in_array($currentRoute, ['guest.dashboard', 'guest.show']) && str_starts_with($currentRoute, 'guest'));
                    $guestBooksActive = $currentRoute === 'guest.dashboard' || $currentRoute === 'guest.show';
                @endphp
                <a href="{{ route('guest.about') }}" class="nav-link @if($guestAboutActive) active @endif">
                    About
                </a>

                <a href="{{ route('guest.dashboard') }}" class="nav-link @if($guestBooksActive) active @endif">
                    Books
                </a>
            @else
                <!-- Authenticated User: All links -->
                @auth
                    @php
                        $userHomeActive = $currentRoute === 'home' || $currentRoute === 'dashboard';
                        $userAboutActive = $currentRoute === 'about';
                        $userBooksActive = $currentRoute === 'books.index' || $currentRoute === 'books.show';
                        $userBorrowingsActive = $currentRoute === 'borrowings.index';
                        $userContactActive = $currentRoute === 'contact';
                        $userAdminActive = str_starts_with($currentRoute, 'admin.');
                    @endphp
                    <a href="{{ route('home') }}" class="nav-link @if($userHomeActive) active @endif">
                        Home
                    </a>
                    
                    <a href="{{ route('about') }}" class="nav-link @if($userAboutActive) active @endif">
                        About
                    </a>

                    <a href="{{ route('books.index') }}" class="nav-link @if($userBooksActive) active @endif">
                         Books
                    </a>

                    <a href="{{ route('borrowings.index') }}" class="nav-link @if($userBorrowingsActive) active @endif">
                        Borrowings
                    </a>

                    <a href="{{ route('contact') }}" class="nav-link @if($userContactActive) active @endif">
                        Contact
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @if($userAdminActive) active @endif">
                            Admin Panel
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Right Side Menu -->
        <div class="navbar-right">
            @if(session()->get('guest_mode'))
                <a href="{{ route('guest.logout') }}" class="btn btn-primary btn-sm">Exit Guest Mode</a>
            @elseif(auth()->check())
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">
                        Logout
                    </button>
                </form>
            @endif
        </div>

        <!-- Hamburger Menu -->
        <button class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</nav>

<style>
html {
    scrollbar-gutter: stable;
}

body {
    overflow-y: scroll;
}

.navbar {
    background-color: white;
    border-bottom: 1px solid var(--color-border);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);

}

.navbar-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.navbar-brand {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}


.navbar-menu {
    display: flex;
    gap: 2rem;
    margin: 0;
    padding: 0 3rem;
    list-style: none;
    flex-grow: 0;
    white-space: nowrap;
}

.navbar-right {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-shrink: 0;
    white-space: nowrap;
}

.navbar-logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--color-primary);
    text-decoration: none;
    white-space: nowrap;
}

.nav-link {
    color: var(--color-text);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
    padding: 0.25rem 0;
}

.nav-link:hover,
.nav-link.active {
    color: var(--color-primary);
}



.navbar .hamburger {
    display: none;
    flex-direction: column;
    background: none;
    border: none;
    cursor: pointer;
    gap: 5px;
    z-index: 99;
    padding: 0.25rem;
}

.navbar .hamburger span {
    width: 24px;
    height: 4px;
    background-color: var(--color-primary);
    border-radius: 2px;
    transition: all 0.3s;
}

.close-menu {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--color-primary);
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar .hamburger {
        display: flex;
    }

    .navbar-menu {
        position: fixed;
        top: 0;
        right: -300px;
        width: 200px;
        height: 100dvh;
        background-color: white;
        flex-direction: column;
        padding: 1.5rem;
        gap: 1rem;
        transition: right 0.3s ease;
        box-shadow: -4px 0 12px rgba(0, 0, 0, 0.15);
        z-index: 200;
        overflow-y: auto;
    }

    .navbar-menu.active {
        right: 0;
    }

    .close-menu {
        display: block;
        align-self: flex-start;
        padding: 0.1rem;
        font-size: 1.5rem;
    }

    .navbar-container {
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    .nav-link {
        padding: 0.25rem 0;
        font-size: 1rem;
    }

    .navbar-right {
        gap: 0.5rem;
    }

    .btn {
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
    }
}

@media (max-width: 480px) {
    .navbar-logo {
        font-size: 1.25rem;
    }

    .nav-link {
        font-size: 1rem;
    }

    .navbar-menu {
        gap: 0.5rem;
    }
    
    .navbar .hamburger {
        display: flex;
    }
    
    .btn {
        font-size: 0.875rem;
        padding: 0.75rem 1.5rem;
    }
}
</style>

<script>
function closeMenu() {
    const hamburger = document.getElementById('hamburger');
    const navbarMenu = document.getElementById('navbarMenu');
    if (hamburger) hamburger.classList.remove('active');
    if (navbarMenu) navbarMenu.classList.remove('active');
    document.body.classList.remove('menu-open');
}

function toggleMenu() {
    const hamburger = document.getElementById('hamburger');
    const navbarMenu = document.getElementById('navbarMenu');
    if (hamburger) hamburger.classList.toggle('active');
    if (navbarMenu) navbarMenu.classList.toggle('active');
    document.body.classList.toggle('menu-open');
}

// Klik link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', closeMenu);
});

// Close button di navbar
const closeBtn = document.querySelector('.close-menu');
if (closeBtn) {
    closeBtn.addEventListener('click', closeMenu);
}

// Klik di luar navbar
document.addEventListener('click', (event) => {
    const navbar = document.querySelector('.navbar');
    const hamburger = document.getElementById('hamburger');
    const navbarMenu = document.getElementById('navbarMenu');
    
    if (navbar && hamburger && navbarMenu) {
        if (!navbar.contains(event.target) && navbarMenu.classList.contains('active')) {
            closeMenu();
        }
    }
});
</script>

