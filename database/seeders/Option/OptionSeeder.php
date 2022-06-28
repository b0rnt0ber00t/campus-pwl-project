<?php

namespace Database\Seeders\Option;

//use App\Enums\Timer;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
            'name' => 'timer_count',
            'value' => 'second'
        ]);

        Option::create([
            'name' => 'price',
            'value' => 20000
        ]);
    }
}
