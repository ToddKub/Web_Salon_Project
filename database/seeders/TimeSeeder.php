<?php

namespace Database\Seeders;
use App\Models\AvailableTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AvailableTime::create(['time_slot' => '10.00->12.00']);
        AvailableTime::create(['time_slot' => '12.00->13.00']);
        AvailableTime::create(['time_slot' => '14.00->15.00']);
        AvailableTime::create(['time_slot' => '19.00->20.00']);
        AvailableTime::create(['time_slot' => '16.00->17.00']);

    }
}
