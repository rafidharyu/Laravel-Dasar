<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::insert([
            [
                'id' => 1,
                'uuid' => Str::uuid(),
                'name' => 'Dr. John Doe',
                'email' => 'johndoe@doe',
                'phone' => '1234567890',
                'gender' => 'male',
            ],
            [
                'id' => 2,
                'uuid' => Str::uuid(),
                'name' => 'Dr. Jane Doe',
                'email' => 'janedoe@doe',
                'phone' => '1234567890',
                'gender' => 'female',
            ]
            ]);
    }
}
