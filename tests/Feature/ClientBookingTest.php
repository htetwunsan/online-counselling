<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ClientBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_client_bookings_return_correct_bookings()
    {
        /** @var User $client */
        $client = User::factory()->create(['role' => 'client'])->fresh();
        $counsellors = User::factory(5)->create(['role' => 'counsellor'])->fresh();

        $bookings = $counsellors->map(function ($counsellor) use ($client) {
            return Booking::create(['booker_id' => $client->id, 'booked_id' => $counsellor->id]);
        });

        Sanctum::actingAs($client);

        $response = $this->getJson(route('api.clients.bookings'));
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
                    'counsellor',
                    'counsellor.id',
                    'counsellor.name',
                    'counsellor.email',
                    'counsellor.email_verified_at',
                    'counsellor.role',
                    'counsellor.created_at',
                    'counsellor.updated_at'
                ]))
        );
    }
}
