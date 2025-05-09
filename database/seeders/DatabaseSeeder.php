<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'test1',
            'email' => 'test1@test.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('12341234'),
            'is_tugas' => false,
        ]);

        User::create([
            'nama' => 'test2',
            'email' => 'test2@test.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('12341234'),
            'is_tugas' => false,
        ]);

        User::create([
            'nama' => 'test3',
            'email' => 'test3@test.com',
            'jabatan' => 'Admin',
            'password' => Hash::make('12341234'),
            'is_tugas' => false,
        ]);

        User::create([
            'nama' => 'Nepry',
            'email' => 'nepry@test.com',
            'jabatan' => 'Admin',
            'password' => Hash::make('12341234'),
            'is_tugas' => false,
        ]);
    }
}
