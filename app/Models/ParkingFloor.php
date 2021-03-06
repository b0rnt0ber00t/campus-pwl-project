<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingFloor extends Model
{
    use HasFactory;

    protected $fillable = ['floor'];

    public function parking()
    {
        return $this->hasMany(Parking::class);
    }
}
