<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;
use App\Models\Room;

class ParkingController extends Controller
{

    /**
     * Function that returns all the available houses.
     */
    public function getHouses()
    {
        $houses = House::withCount([
            'parkingSpots as total_spots',
            'parkingSpots as available_spots' => function ($query) {
                $query->where('status', 'available');
            },
        ])->get();
    
        return response()->json($houses);
    }
    
    /**
     * Function that returns open parking spots.
     */

    public function getFreeParkingSpots(Request $request)
    {
        $houseId = $request->query('house_id');
        
        // Validate the request to ensure house_id is provided
        if (!$houseId) {
            return response()->json(['message' => 'house_id is required'], 400);
        }
    
        // Fetch parking spots associated with the given house_id and are available
        $parkingSpots = ParkingSpot::where('house_id', $houseId)
            ->where('status', 'available')
            ->get();
    
        return response()->json($parkingSpots);
    }
     
    /**
     * Function to book a parking spot.
     */

    public function bookParkingSpot(Request $request)
    {
        $spotId = $request->input('spot_id');
        $vehicleRegNumber = $request->input('vehicle_reg_number');
        $houseId = $request->input('house_id');
        $roomId = $request->input('room_id');
    

        $parkingSpot = ParkingSpot::where('id', $spotId)
            ->where('house_id', $houseId)
            ->first();
    
        if (!$parkingSpot) {
            return response()->json(['success' => false, 'message' => 'Invalid parking spot or mismatch with house'], 400);
        }
    
        if ($parkingSpot->status === 'available') {
            $parkingSpot->update([
                'status' => 'occupied',
                'vehicle_reg_number' => $vehicleRegNumber,
                'room_id' => $roomId,
            ]);
            return response()->json(['success' => true, 'message' => 'Parking spot booked successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Parking spot is already occupied'], 400);
    }

    /**
     * Function to get rooms.
     */

    public function getRooms(Request $request)
    {
        $houseId = $request->query('house_id');

        if (!$houseId) {
            return response()->json(['message' => 'house_id is required'], 400);
        }

        $rooms = Room::where('house_id', $houseId)->get();

        return response()->json($rooms);
    }

}

