<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Beautician;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(4)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test admin',
             'email' => 'admin@example.com',
             'userType'=>'ADM',
             'password' => Hash::make('12345678'),
         ]
         
        );
        \App\Models\User::factory()->create([
            'name' => 'Test customer',
            'email' => 'user@example.com',
            'userType'=>'USR',
            'password' => Hash::make('12345678'),
        ]
        
       );
       $this->call([
        BeauticianSeeder::class,
        ServiceSeeder::class,
        TimeSeeder::class,
    ]);
    }
}
