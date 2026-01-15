<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10|max:5000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Pesan Anda telah dikirim! Kami akan segera merespons melalui email atau nomor telepon.');
    }
}
