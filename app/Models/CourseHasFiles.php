<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseHasFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'course_id',
        'file',
        'title',
        'email',
        'created_at',
        'updated_at',
    ];
}
