<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;
use App\Models\Room;

class ParkingController extends Controller
{
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
     

    public function bookParkingSpot(Request $request)
    {
        $spotId = $request->input('spot_id');
        $vehicleRegNumber = $request->input('vehicle_reg_number');
        $houseId = $request->input('house_id'); // Get house_id from request
        $roomId = $request->input('room_id');   // Get room_id from request (optional)
    
        // Find the parking spot in the correct house, irrespective of room_id
        $parkingSpot = ParkingSpot::where('id', $spotId)
            ->where('house_id', $houseId)  // Ensure the parking spot belongs to the correct house
            ->first();
    
        if (!$parkingSpot) {
            return response()->json(['success' => false, 'message' => 'Invalid parking spot or mismatch with house'], 400);
        }
    
        // Proceed to book the spot if it's available
        if ($parkingSpot->status === 'available') {
            $parkingSpot->update([
                'status' => 'occupied',
                'vehicle_reg_number' => $vehicleRegNumber,
                'room_id' => $roomId,  // Associate with room when booking
            ]);
            return response()->json(['success' => true, 'message' => 'Parking spot booked successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Parking spot is already occupied'], 400);
    }
    
    


    public function getRooms(Request $request)
    {
        $houseId = $request->query('house_id');

        // Validate the request to ensure house_id is provided
        if (!$houseId) {
            return response()->json(['message' => 'house_id is required'], 400);
        }

        // Fetch rooms associated with the given house_id
        $rooms = Room::where('house_id', $houseId)->get();

        return response()->json($rooms);
    }

}

