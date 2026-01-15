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
                <strong>Registration Failed!</strong>
                <ul class="mt-2" style="padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register.store') }}" id="registerForm">
            @csrf

            <!-- Form Title -->
            <div class="text-center mb-6">
                <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem;">Register Admin</h1>
                <p class="text-light">Administrator Registration</p>
            </div>

            <!-- Full Name -->
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input 
                    id="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus
                    placeholder="John Doe"
                >
                @error('name')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
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
                    placeholder="admin@example.com"
                >
                @error('email')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
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

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        required
                        placeholder="Confirm your password"
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
            </div>

            <button type="submit" class="btn btn-primary w-full mb-4">
                Register as Admin
            </button>

            <div class="text-center pt-4" style="border-top: 1px solid var(--color-border); margin-top: 1.5rem;">
                <p class="text-sm text-light">
                    Already have an account? 
                    <a href="{{ route('admin.login') }}" class="text-primary font-semibold hover:underline">
                        Login here
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
