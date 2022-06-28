<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'finish',
        'code',
        'payment_type',
        'parking_id'
    ];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }
}
