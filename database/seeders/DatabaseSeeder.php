<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin MediTrack',
            'email' => 'admin@meditrack.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Dr. Anita Dewi',
            'email' => 'doctor@meditrack.test',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'specialty' => 'General Practitioner',
        ]);

        User::factory()->create([
            'name' => 'Apoteker Budi',
            'email' => 'pharmacist@meditrack.test',
            'password' => Hash::make('password'),
            'role' => 'pharmacist',
        ]);

        User::factory()->create([
            'name' => 'Pasien Aisyah',
            'email' => 'patient@meditrack.test',
            'password' => Hash::make('password'),
            'role' => 'patient',
        ]);
    }
}
