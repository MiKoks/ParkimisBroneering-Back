<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\House;
use App\Models\Room;
use App\Models\ParkingSpot;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParkingSpotTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_mark_a_parking_spot_as_occupied()
    {
        $spot = ParkingSpot::factory()->create(['status' => 'available']);

        $spot->update(['status' => 'occupied']);

        $this->assertEquals('occupied', $spot->fresh()->status);
    }

    /** @test */
    public function test_it_can_fetch_all_available_spots_for_a_house()
    {
        $house = House::factory()->create();
    
        $room = Room::factory()->create(['house_id' => $house->id]);
    
        ParkingSpot::factory()->create([
            'house_id' => $house->id,
            'room_id' => $room->id,
            'status' => 'available',
        ]);
    
        $availableSpots = ParkingSpot::where('house_id', $house->id)
                                     ->where('status', 'available')
                                     ->get();
    
        $this->assertCount(1, $availableSpots);
    }

}
