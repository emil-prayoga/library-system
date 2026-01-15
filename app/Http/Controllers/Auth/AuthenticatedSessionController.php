<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on user role
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false))->with('status', 'Welcome back, Admin!');
        }

        return redirect()->intended(route('home', absolute: false))->with('status', 'Login successful!');
    }

    /**
     * Display the admin login view.
     */
    public function adminCreate(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function adminStore(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Verify user is admin BEFORE regenerating session
        $user = auth()->user();
        if (!$user->isAdmin()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->withErrors(['email' => 'You do not have admin access.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false))->with('status', 'Welcome back, Admin!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Check if user was admin before logout
        $isAdmin = auth()->user() && auth()->user()->isAdmin();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect admin to admin login, others to user login
        if ($isAdmin) {
            return redirect()->route('admin.login')->with('status', 'Logout successful!');
        }

        return redirect()->route('login')->with('status', 'Logout successful!');
    }
}
