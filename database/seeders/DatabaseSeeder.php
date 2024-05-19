<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Instansi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => '1',
        ]);

        User::create([
            'name' => 'Agun Wiguna',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role_id' => '2',
        ]);

        Instansi::create([
            'name' => 'SMA Informatika Ciamis',
            'adress' => 'Jln. Bojonghuni No.09, Malaber, Ciamis',
            'radius' => '20',
            'leader_name' => 'Dudi Gunawan, S.Pd',
            'latitude' => '-7.323212083708643',
            'longitude' => '108.3457463090454'
        ]);

        Role::create([
            'name' => 'Admin',
        ]);

        Role::create([
            'name' => 'User',
        ]);
    }
}
