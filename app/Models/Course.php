<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['course_name', 'course_description', 'course_image', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
