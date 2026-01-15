<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    public function markAsArchived()
    {
        $this->update(['status' => 'archived']);
    }

    public function isUnread()
    {
        return $this->status === 'unread';
    }
}
