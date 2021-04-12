<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementHasPictures extends Model
{
    use HasFactory;
    public $timestamps = false; // removing the timestamps
    protected $fillable = [
        'advertisement_id',
        'picture',
    ];
}
