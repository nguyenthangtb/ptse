<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'source',
        'status',
        'read_at',
        'replied_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    // Scope for unread messages
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    // Scope for read messages
    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    // Scope for replied messages
    public function scopeReplied($query)
    {
        return $query->whereNotNull('replied_at');
    }

    // Mark as read
    public function markAsRead()
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    // Mark as replied
    public function markAsReplied()
    {
        if (!$this->replied_at) {
            $this->update(['replied_at' => now(), 'status' => 'replied']);
        }
    }
}
