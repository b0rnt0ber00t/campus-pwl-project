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

    public function time()
    {
        return bcsub(microtime(true) - $this->start, 6);
    }

    public function hour(int $price)
    {
        return floor($this->time() / 3600) * $price;
    }

    public function minute(int $price)
    {
        return floor($this->time() / 60) * $price;
    }

    public function second(int $price)
    {
        return $this->time() * $price;
    }
}
