<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;

    public $timestamps = false; // removing the timestamps
    
    protected $fillable = [
        'login', 
        'name',
        'password',
        'email',
        'firebase_token',
    ];
}
