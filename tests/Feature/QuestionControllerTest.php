<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\SpecialitySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class]);

        $response = $this->getJson(route('questions.index'));



        $response->assertOk();
    }

    public function test_store()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class]);

        $client = User::factory()->create(['role' => 'counsellor'])->fresh();

        Sanctum::actingAs($client);

        $response = $this->postJson(route('questions.store'), [
            'name' => 'I am a cat',
            'specialities' => [1, 2, 3]
        ]);



        $response->assertCreated();
    }

    public function test_show()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class]);

        $response = $this->getJson(route('questions.show', ['question' => Question::first()]));



        $response->assertOk();
    }

    public function test_update()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class]);

        $client = User::factory()->create(['role' => 'counsellor'])->fresh();

        Sanctum::actingAs($client);

        $response = $this->putJson(route('questions.update', ['question' => Question::first()]), [
            'name' => 'I am a cat',
            'specialities' => [1, 2, 3]
        ]);



        $response->assertOk();
    }

    public function test_destroy()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class]);

        $client = User::factory()->create(['role' => 'counsellor'])->fresh();

        Sanctum::actingAs($client);

        $response = $this->deleteJson(route('questions.destroy', ['question' => Question::first()]));



        $response->assertNoContent();
    }
}
