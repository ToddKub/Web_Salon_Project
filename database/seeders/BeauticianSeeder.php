<?php

namespace Database\Seeders;
use App\Models\Beautician;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeauticianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Beautician::create(['name' => 'ช่างกี่']);
        Beautician::create(['name' => 'ช่างตูมตาม']);
        Beautician::create(['name' => 'ช่างน้ำ']);
    }
}
