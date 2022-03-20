<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::updateOrCreate(['name' => 'depression']);
        Speciality::updateOrCreate(['name' => 'anxiety']);
        Speciality::updateOrCreate(['name' => 'stress']);
        Speciality::updateOrCreate(['name' => 'relationships']);
        Speciality::updateOrCreate(['name' => 'grief']);
        Speciality::updateOrCreate(['name' => 'trauma']);
        Speciality::updateOrCreate(['name' => 'self-esteem']);
        Speciality::updateOrCreate(['name' => 'guidance']);
        Speciality::updateOrCreate(['name' => 'anger']);
    }
}
