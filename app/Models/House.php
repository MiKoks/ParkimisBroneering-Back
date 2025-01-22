<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total_parking_spots'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function parkingSpots()
    {
        return $this->hasMany(ParkingSpot::class);
    }

    public function availableParkingSpots()
    {
        return $this->parkingSpots()->where('status', 'available');
    }
}

