<?php

namespace Tests\Feature\Models;

use App\Models\Booking;
use App\Models\ClientDetail;
use App\Models\PreferLanguage;
use App\Models\Question;
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


class ClientDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_return_correct_user()
    {
        $user = User::factory()->create(['role' => 'client'])->fresh();
        $detail = ClientDetail::find($user->detail->id);

        $this->assertTrue($detail->user->is($user));
    }

    public function test_questions_return_correct_relation()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class]);

        $user = User::factory()->create(['role' => 'client'])->fresh();
        $detail = $user->detail;

        $questions = Question::all();

        $detail->questions()->syncWithoutDetaching($questions->pluck('id'));

        $detail->questions->each(function ($q) use ($questions) {
            $this->assertTrue($questions->contains($q));
        });
    }

    public function test_specialities_return_correct_relation()
    {
        $this->seed([SpecialitySeeder::class]);

        $user = User::factory()->create(['role' => 'client'])->fresh();
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

        $user = User::factory()->create(['role' => 'client'])->fresh();
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

        $user = User::factory()->create(['role' => 'client'])->fresh();
        $detail = $user->detail;

        $preferLanguages = PreferLanguage::all();

        $detail->preferLanguages()->syncWithoutDetaching($preferLanguages->pluck('id'));

        $detail->preferLanguages->each(function ($pl) use ($preferLanguages) {
            $this->assertTrue($preferLanguages->contains($pl));
        });
    }

    public function test_has_booked_return_correct_result()
    {
        $client = User::factory()->create(['role' => 'client'])->fresh();
        $counsellor = User::factory()->create(['role' => 'counsellor'])->fresh();

        $this->assertFalse($client->detail->hasBooked($counsellor->detail));

        Booking::create(['booker_id' => $client->id, 'booked_id' => $counsellor->id]);

        $this->assertTrue($client->detail->hasBooked($counsellor->detail));
    }

    public function test_bookings_return_correct_relation()
    {
        $client = User::factory()->create(['role' => 'client'])->fresh();
        $counsellor = User::factory()->create(['role' => 'counsellor'])->fresh();

        Booking::create(['booker_id' => $client->id, 'booked_id' => $counsellor->id]);

        $this->assertEquals($client->detail->bookings, $counsellor->detail->bookings);
    }
}
