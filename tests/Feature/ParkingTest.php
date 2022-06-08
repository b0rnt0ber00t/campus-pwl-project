<?php

namespace Tests\Feature;

use App\Models\Parking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParkingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_parking_route_get()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('parking.index'));

        $response->assertStatus(200);
    }

    public function test_parking_create()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post(route('parking.store'), [
            'number' => 99,
            'is_available' => true
        ]);

        $response->assertRedirect(route('parking.index'));
    }

    public function test_parking_update()
    {
        $user = User::find(1);
        $park = Parking::create([
            'number' => 99,
            'is_available' => true
        ]);

        $this->actingAs($user)->put(route('parking.update', $park->id), [
            'number' => 99,
            'is_available' => false
        ]);

        $park = Parking::find($park->id);

        $this->assertFalse($park->is_available);
    }

    public function test_parking_delete()
    {
        $user = User::find(1);
        $park = Parking::create([
            'number' => 99,
            'is_available' => true
        ]);

        $response = $this->actingAs($user)->delete(route('parking.destroy', $park->id));

        $response->assertRedirect(route('parking.index'));
    }
}
