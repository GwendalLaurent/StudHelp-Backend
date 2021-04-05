<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{

    public $timestamps = false; // removing the timestamps

    use HasFactory;

    protected $fillable = [
        'user_email',
        'discord',
        'teams',
        'facebook',
    ];
}
