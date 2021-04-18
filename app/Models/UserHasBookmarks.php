<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasBookmarks extends Model
{
    use HasFactory;



    public $timestamps = false; // removing the timestamps

    protected $fillable = [
        'user_email',
        'advertisement_id'
    ];
}
