<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('role', '!=', 'admin')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users.index', compact('users', 'search'));
    }

    public function show(User $user)
    {
        if ($user->isAdmin()) {
            abort(403, 'Tidak dapat melihat detail admin');
        }
        return view('admin.users.show', compact('user'));
    }

    public function block(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat memblokir admin');
        }

        $user->block();
        return back()->with('success', "User {$user->name} telah diblokir");
    }

    public function unblock(User $user)
    {
        $user->unblock();
        return back()->with('success', "User {$user->name} telah dibuka blokir");
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus admin');
        }

        $name = $user->name;
        $user->delete();
        return back()->with('success', "User $name telah dihapus");
    }
}
