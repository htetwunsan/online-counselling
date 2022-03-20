<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CounsellorBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_counsellor_bookings_return_correct_bookings()
    {
        /** @var User $counsellor */
        $counsellor = User::factory()->create(['role' => 'counsellor'])->fresh();
        $clients = User::factory(5)->create(['role' => 'client'])->fresh();

        $bookings = $clients->map(function ($client) use ($counsellor) {
            return Booking::create(['booker_id' => $client->id, 'booked_id' => $counsellor->id]);
        });

        Sanctum::actingAs($counsellor);
        $response = $this->getJson(route('api.counsellors.bookings'));
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has($bookings->count())
                ->each(fn (AssertableJson $json) =>
                $json->hasAll([
                    'id',
                    'booker_id',
                    'booked_id',
                    'created_at',
                    'updated_at',
                    'client',
                    'client.id',
                    'client.name',
                    'client.email',
                    'client.email_verified_at',
                    'client.role',
                    'client.created_at',
                    'client.updated_at'
                ]))
        );
    }
}
