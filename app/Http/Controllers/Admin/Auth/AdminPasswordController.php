<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPasswordController extends Controller
{
    public function show()
    {
        return view('auth.admin-reset-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $admin = User::where('email', $request->email)
            ->where('role', 'admin')
            ->firstOrFail();

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.login')
            ->with('status', 'Password admin berhasil direset.');
    }
}
