<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'content',
        'commentable_type',
        'commentable_id',
        'is_approved',
        'is_featured',
        'is_private'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'is_private' => 'boolean'
    ];

    // Polymorphic relationship
    public function commentable()
    {
        return $this->morphTo();
    }

    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Parent comment relationship
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Child comments relationship
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
