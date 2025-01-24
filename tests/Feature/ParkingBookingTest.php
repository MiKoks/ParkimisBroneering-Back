<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\House;
use App\Models\Room;
use App\Models\ParkingSpot;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParkingBookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_allows_user_to_book_parking_spot()
    {
        $house = House::factory()->create();
        $room = Room::factory()->create(['house_id' => $house->id]);
        $parkingSpot = ParkingSpot::factory()->create([
            'house_id' => $house->id,
            'room_id' => $room->id,
            'status' => 'available',
        ]);

        $response = $this->postJson('/api/book-parking', [
            'house_id' => $house->id,
            'room_id' => $room->id,
            'spot_id' => $parkingSpot->id,
            'vehicle_reg_number' => 'ABC123',
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Parking spot booked successfully',
                ]);

        $this->assertDatabaseHas('parking_spots', [
            'id' => $parkingSpot->id,
            'status' => 'occupied',
            'vehicle_reg_number' => 'ABC123',
        ]);
    }

    /** @test */
    public function it_returns_an_error_if_the_parking_spot_is_already_occupied()
    {
        $spot = ParkingSpot::factory()->create(['status' => 'occupied']);

        $response = $this->postJson('/api/book-parking', [
            'house_id' => $spot->house_id,
            'room_id' => 1,
            'spot_id' => $spot->id,
            'vehicle_reg_number' => 'TEST123',
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Parking spot is already occupied',
        ]);
        

        $this->assertDatabaseHas('parking_spots', [
            'id' => $spot->id,
            'status' => 'occupied',
        ]);
    }

}
