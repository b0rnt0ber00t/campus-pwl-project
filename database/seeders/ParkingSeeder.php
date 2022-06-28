<?php

namespace Database\Seeders;

use App\Models\Parking;
use App\Models\ParkingFloor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParkingFloor::factory(5)->create();
        Parking::factory(10)->create();
    }
}
