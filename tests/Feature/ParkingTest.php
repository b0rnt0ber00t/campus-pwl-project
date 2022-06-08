<?php

namespace Tests\Feature;

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
}
