<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'title',
        'user_email',
        'type',
        'description',
    ];
}
