<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::updateOrCreate(['name' => 'messaging']);
        Service::updateOrCreate(['name' => 'live chat']);
        Service::updateOrCreate(['name' => 'phone']);
        Service::updateOrCreate(['name' => 'video']);
    }
}
