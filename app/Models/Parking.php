<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'is_available', 'parking_floor_id'];

    protected $casts = [
        'is_available' => 'boolean'
    ];
}
