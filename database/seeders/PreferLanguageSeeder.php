<?php

namespace Database\Seeders;

use App\Models\PreferLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PreferLanguage::updateOrCreate(['name' => 'english']);
        PreferLanguage::updateOrCreate(['name' => 'burmese']);
        PreferLanguage::updateOrCreate(['name' => 'korean']);
        PreferLanguage::updateOrCreate(['name' => 'japanese']);
    }
}
