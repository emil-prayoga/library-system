<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMessageController extends Controller
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
        $status = $request->get('status');
        
        // Build query
        $query = Message::orderBy('created_at', 'desc');
        if ($status) {
            $query->where('status', $status);
        }
        
        $messages = $query->paginate(10);

        // Get counts for all statuses
        $totalMessages = Message::count();
        $unreadMessages = Message::where('status', 'unread')->count();
        $readMessages = Message::where('status', 'read')->count();
        $archivedMessages = Message::where('status', 'archived')->count();

        return view('admin.messages.index', compact('messages', 'status', 'totalMessages', 'unreadMessages', 'readMessages', 'archivedMessages'));
    }

   public function show(Message $message)
{
    $prevMessage = Message::where('created_at', '>', $message->created_at)
        ->orderBy('created_at', 'asc')
        ->first();

    $nextMessage = Message::where('created_at', '<', $message->created_at)
        ->orderBy('created_at', 'desc')
        ->first();

    return view('admin.messages.show', compact(
        'message',
        'prevMessage',
        'nextMessage'
    ));
}


    public function markAsRead(Message $message)
    {
        $message->markAsRead();
        return back()->with('success', 'Pesan ditandai sebagai dibaca');
    }

    public function markAsArchived(Message $message)
    {
        $message->markAsArchived();
        return back()->with('success', 'Pesan diarsipkan');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Pesan dihapus');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->get('ids', []);
        Message::whereIn('id', $ids)->delete();
        return back()->with('success', 'Pesan-pesan dihapus');
    }

    
}
