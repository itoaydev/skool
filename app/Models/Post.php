<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_description',
        'group_id',
        'user_id',
        'like',
    ];

    protected $appends = [
        'author_name',
        'author_image'
    ];

    /**
     * Get the group that owns the post.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAuthorNameAttribute(): string
    {
        return $this->user()->first()->name ?? "";
    }
    public function getAuthorImageAttribute(): ?string
    {
        return $this->user()->first()->image ?? null;
    }
  
}
