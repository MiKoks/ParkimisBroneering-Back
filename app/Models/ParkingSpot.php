<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'room_id', 'status', 'vehicle_reg_number'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

