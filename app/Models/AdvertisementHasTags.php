<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementHasTags extends Model
{
    public $timestamps = false; // removing the timestamps

    use HasFactory;

    protected $fillable = [
        'advertisement_id',
        'tag_type',
        'tag_value',
    ];
}
