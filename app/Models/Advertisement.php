<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{

    public $timestamps = false; // removing the timestamps

    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'user_email',
        'type',
        'description',
    ];
}
