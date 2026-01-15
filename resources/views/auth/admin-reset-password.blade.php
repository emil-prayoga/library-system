@extends('layouts.auth')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%) !important;
    }
    .min-h-screen {
        background: transparent !important;
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
        @if ($errors->any())
            <div class="alert alert-error mb-4">
                <strong>Reset Failed!</strong>
                <ul class="mt-2" style="padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.store') }}" id="resetForm">
            @csrf

            <!-- Form Title -->
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin: 0;">Reset Password Admin</h2>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
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
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required
                        placeholder="Minimum 8 characters"
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
                <small style="color: var(--color-text-light);">Must be at least 8 characters</small>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        name="password_confirmation" 
                        required
                        placeholder="Re-enter your password"
                        style="padding-right: 2.5rem;"
                    >
                    <button 
                        type="button" 
                        style="position: absolute; right: 0.75rem; background: none; border: none; cursor: pointer; color: var(--color-text-light); padding: 0.5rem; display: flex; align-items: center; justify-content: center; width: 2rem; height: 2rem;"
                        onclick="togglePasswordVisibility('password_confirmation')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full mb-4">
                Reset Password
            </button>

            <!-- Back to Login -->
            <div class="text-center pt-4" style="border-top: 1px solid var(--color-border); margin-top: 1.5rem;">
                <p class="text-sm text-light">
                    <a href="{{ route('admin.login') }}" class="text-primary font-semibold hover:underline">
                        Back to Admin Sign In
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<style>
    .is-invalid {
        border-color: var(--color-danger);
    }
    .text-danger {
        color: var(--color-danger);
    }
    small {
        display: block;
        margin-top: 5px;
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
