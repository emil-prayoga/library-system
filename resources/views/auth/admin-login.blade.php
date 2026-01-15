@extends('layouts.auth')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%) !important;
    }
    .min-h-screen {
        background: transparent !important;
    }

    input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin: 0;
    vertical-align: middle;

    /* KUNCI ukuran */
    box-sizing: border-box;

    /* Hilangkan perubahan visual browser */
    outline: none;
}

input[type="checkbox"]:focus {
    outline: none;
    box-shadow: none;
}

input[type="checkbox"]:checked {
    outline: none;
}
/* Edge, Chrome (WebKit / Chromium) */
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
    display: none;
}

/* Chrome, Safari */
input[type="password"]::-webkit-credentials-auto-fill-button {
    display: none !important;
}

/* Firefox (tidak punya ikon, tapi aman) */
input[type="password"] {
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
}


</style>

<div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; background: transparent; padding: 1rem; position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
    <div class="card" style="width: 100%; max-width: 450px; background: var(--color-bg); box-shadow: 0 20px 25px rgba(0,0,0,0.3); position: relative; z-index: 10;">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem;">Login Admin</h1>
            <p class="text-light">Administrator Access Only</p>
        </div>

        <!-- Alerts -->
        @if ($errors->any())
            <div class="alert alert-error mb-4">
                <strong>Login Failed!</strong>
                <p style="margin-top: 0.5rem;">{{ $errors->first() }}</p>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Admin Login Form -->
        <form method="POST" action="{{ route('admin.login.store') }}" id="adminLoginForm">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Admin Email Address</label>
                <input 
                    id="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="admin@example.com"
                >
                @error('email')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Admin Password</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required
                        placeholder="Enter your password"
                        style="padding-right: 2.5rem;"
                    >
                    <button 
                        type="button" 
                        style="position: absolute; right: 0.75rem; background: none; border: none; cursor: pointer; color: var(--color-text-light); padding: 0.5rem; display: flex; align-items: center; justify-content: center; width: 2rem; height: 2rem;"
                        onclick="togglePasswordVisibility('password')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
                <label for="remember" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input 
                        id="remember" 
                        type="checkbox" 
                        name="remember"
                        style="width: 18px; height: 18px; cursor: pointer;"
                    >
                    <span class="text-sm">Remember me</span>
                </label>

               
                    <a href="{{ route('admin.password.request') }}" class="text-primary text-sm hover:underline">
                        Forgot password?
                    </a>
            </div>

            <button type="submit" class="btn btn-primary w-full mb-4" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                Admin Sign In
            </button>

            <div class="text-center pt-4" style="border-top: 1px solid var(--color-border); margin-top: 1.5rem;">
                <p class="text-sm text-light" style="margin-bottom: 0.75rem;">
                    Are you a regular user? 
                    <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">
                        Login here
                    </a>
                </p>
                
                <p class="text-sm text-light" style="margin-top: 0.75rem;">
                    Don't have an admin account? 
                    <a href="{{ route('admin.register') }}" class="text-primary font-semibold hover:underline">
                        Register as Admin
                    </a>
                </p>
            </div>
        </form>

        <!-- Admin Info Box -->
        <div style="margin-top: 1.5rem; padding: 1rem; background: linear-gradient(135deg, #f3e8ff 0%, #ede9fe 100%); border-left: 4px solid #a78bfa; border-radius: 4px;">
            <p class="text-sm" style="margin: 0; color: #5b21b6;">
                <strong>📋 Admin Access:</strong> This portal grants you access to manage books, borrowings, and system settings.
            </p>
        </div>
    </div>
</div>

<style>
    .is-invalid {
        border-color: var(--color-danger);
    }
    .text-danger {
        color: var(--color-danger);
    }
    .items-center {
        align-items: center;
    }
</style>

<script>
    function togglePasswordVisibility(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const toggleBtn = event.target.closest('button');
        const svg = toggleBtn.querySelector('svg');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            svg.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            passwordField.type = 'password';
            svg.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }
</script>

@endsection
