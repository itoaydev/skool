<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name', 'group_description', 'email', 'group_picture', 'group_icon', 'creator_id', 'completed', 'completed_at',
    ];
    protected $appends = [
        'author_name'
    ];

    // Define the relationship with the User model
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function getAuthorNameAttribute(): string
    {
        return $this->creator()->first()->name ?? "";
    }
}
