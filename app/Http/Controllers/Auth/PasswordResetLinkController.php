<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::where('email', $request->email)
            ->where('role', '!=', 'admin')
            ->firstOrFail();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}