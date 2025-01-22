<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'name'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function parkingSpots()
    {
        return $this->hasMany(ParkingSpot::class);
    }
}
