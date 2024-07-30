<?php

namespace Database\Seeders;
use App\Models\Service;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create(['name' => 'ต่อขนตา', 'price' => 1000]);
        Service::create(['name' => 'ทำคิ้ว ', 'price' => 1600]);
        Service::create(['name' => 'ผังสีอายไลเนอร์', 'price' => 1200]);
        Service::create(['name' => 'ฝังสีปาก', 'price' => 1000]);
        Service::create(['name' => 'ทำเล็บ', 'price' => 500]);
    }
}
