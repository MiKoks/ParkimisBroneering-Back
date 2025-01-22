<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function getHouses()
    {
        return response()->json(House::all());
    }

    public function getFreeParkingSpots(Request $request)
    {
        $houseId = $request->query('house');
        $parkingSpots = ParkingSpot::where('house_id', $houseId)
            ->where('status', 'available')
            ->get();
        return response()->json($parkingSpots);
    }

    public function bookParkingSpot(Request $request)
    {
        $spotId = $request->input('spot_id');
        $vehicleRegNumber = $request->input('vehicle_reg_number');

        $parkingSpot = ParkingSpot::findOrFail($spotId);
        if ($parkingSpot->status === 'available') {
            $parkingSpot->update([
                'status' => 'occupied',
                'vehicle_reg_number' => $vehicleRegNumber,
            ]);
            return response()->json(['success' => true, 'message' => 'Parking spot booked successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Parking spot is already occupied'], 400);
    }
}

