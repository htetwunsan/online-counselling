<?php

namespace Tests\Feature\Models;

use App\Models\Booking;
use App\Models\CounsellorDetail;
use App\Models\Image;
use App\Models\PreferLanguage;
use App\Models\Service;
use App\Models\Speciality;
use App\Models\User;
use Database\Seeders\PreferLanguageSeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SpecialitySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CounsellorDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_return_correct_user()
    {
        $user = User::factory()->create(['role' => 'counsellor'])->fresh();
        $detail = CounsellorDetail::find($user->detail->id);

        $this->assertTrue($detail->user->is($user));
    }

    public function test_latest_image_return_correct_image()
    {
        $user = User::factory()->create(['role' => 'counsellor'])->fresh();
        $detail = $user->detail;
        $images = Image::factory(2)->create(['imageable_id' => $detail->id, 'imageable_type' => CounsellorDetail::class])->fresh();

        $this->assertFalse($detail->latestImage->is($images[0]));
        $this->assertTrue($detail->latestImage->is($images[1]));
    }

    public function test_images_return_correct_relation()
    {
        $user = User::factory()->create(['role' => 'counsellor'])->fresh();
        $detail = $user->detail;
        $images = Image::factory(2)->create(['imageable_id' => $detail->id, 'imageable_type' => CounsellorDetail::class])->fresh();

        $this->assertEquals($detail->images, $images);
    }

    public function test_specialities_return_correct_relation()
    {
        $this->seed([SpecialitySeeder::class]);

        $user = User::factory()->create(['role' => 'counsellor'])->fresh();
        $detail = $user->detail;

        $specialities = Speciality::all();

        $detail->specialities()->syncWithoutDetaching($specialities->pluck('id'));

        $detail->specialities->each(function ($s) use ($specialities) {
            $this->assertTrue($specialities->contains($s));
        });
    }

    public function test_services_return_correct_relation()
    {
        $this->seed([ServiceSeeder::class]);

        $user = User::factory()->create(['role' => 'counsellor'])->fresh();
        $detail = $user->detail;

        $services = Service::all();

        $detail->services()->syncWithoutDetaching($services->pluck('id'));

        $detail->services->each(function ($s) use ($services) {
            $this->assertTrue($services->contains($s));
        });
    }

    public function test_prefer_languages_return_correct_relation()
    {
        $this->seed([PreferLanguageSeeder::class]);

        $user = User::factory()->create(['role' => 'counsellor'])->fresh();
        $detail = $user->detail;

        $preferLanguages = PreferLanguage::all();

        $detail->preferLanguages()->syncWithoutDetaching($preferLanguages->pluck('id'));

        $detail->preferLanguages->each(function ($pl) use ($preferLanguages) {
            $this->assertTrue($preferLanguages->contains($pl));
        });
    }

    public function test_booked_by_return_correct_result()
    {
        $client = User::factory()->create(['role' => 'client'])->fresh();
        $counsellor = User::factory()->create(['role' => 'counsellor'])->fresh();

        $this->assertFalse($counsellor->detail->bookedBy($client->detail));

        Booking::create(['booker_id' => $client->id, 'booked_id' => $counsellor->id]);

        $this->assertTrue($counsellor->detail->bookedBy($client->detail));
    }

    public function test_bookings_return_correct_relation()
    {
        $client = User::factory()->create(['role' => 'client'])->fresh();
        $counsellor = User::factory()->create(['role' => 'counsellor'])->fresh();

        Booking::create(['booker_id' => $client->id, 'booked_id' => $counsellor->id]);

        $this->assertEquals($client->detail->bookings, $counsellor->detail->bookings);
    }
}
