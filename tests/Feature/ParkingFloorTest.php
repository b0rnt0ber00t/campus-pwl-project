<?php

namespace Tests\Feature;

use App\Models\ParkingFloor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParkingFloorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_parking_floor_get()
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/parking');

        $response->assertStatus(200);
    }

    public function test_parking_floor_create()
    {
        $user = User::first();

        $this->actingAs($user)->post('parking/floor', [
            'floor' => 1000
        ]);

        $response = $this->actingAs($user)->get('/parking');

        $response->assertSeeText('Floor 1000');
    }

    public function test_parking_floor_edit()
    {
        $user = User::first();

        $parking_floor = ParkingFloor::create([
            'floor' => 2000
        ]);

        $creating = $this->actingAs($user)->get('/parking');
        $response = $this->actingAs($user)->put('/parking/floor/' . $parking_floor->id . '/edit', [
            'floor' => 3000
        ]);

        $creating->assertSeeText('Floor 2000') && $response->assertSeeText('Floor 3000');
    }

    public function test_parking_floor_delete()
    {
        $user = User::first();

        $parking_floor = ParkingFloor::create([
            'floor' => 2000
        ]);

        $creating = $this->actingAs($user)->get('/parking');
        $response = $this->actingAs($user)->delete('/parking/floor/' . $parking_floor->id);

        $creating->assertSeeText('Floor 2000') && $response->assertDontSee('Floor 2000');
    }
}
