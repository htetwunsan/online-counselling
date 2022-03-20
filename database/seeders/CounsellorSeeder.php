<?php

namespace Database\Seeders;

use App\Models\CounsellorDetail;
use App\Models\Image;
use App\Models\PreferLanguage;
use App\Models\Service;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;

class CounsellorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = Speciality::pluck('id');
        $services = Service::pluck('id');
        $preferLanguages = PreferLanguage::pluck('id');

        $users = User::factory(100)->create(['role' => 'counsellor']);

        $faker = Faker\Factory::create();

        /** @var User $user */
        foreach ($users as $user) {
            $user->detail->update(['description' => $faker->realText(400)]);
            Image::factory()->create([
                'imageable_id' => $user->detail->id,
                'imageable_type' => CounsellorDetail::class
            ]);
            $user->detail
                ->specialities()
                ->withTimeStamps()
                ->syncWithoutDetaching($specialities->random(rand(1, $specialities->count())));
            $user->detail
                ->services()
                ->withTimeStamps()
                ->syncWithoutDetaching($services->random(rand(1, $services->count())));
            $user->detail
                ->preferLanguages()
                ->withTimeStamps()
                ->syncWithoutDetaching($services->random(rand(1, $preferLanguages->count())));
        }
    }
}
