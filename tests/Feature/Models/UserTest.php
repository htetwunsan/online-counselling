<?php

namespace Tests\Feature\Models;

use App\Models\AdminDetail;
use App\Models\ClientDetail;
use App\Models\CounsellorDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_client_return_correct_result()
    {
        $user = User::factory()->create(['role' => 'client'])->fresh();

        $this->assertTrue($user->isClient());
    }

    public function test_is_counsellor_return_correct_result()
    {
        $user = User::factory()->create(['role' => 'counsellor'])->fresh();

        $this->assertTrue($user->isCounsellor());
    }

    public function test_is_admin_return_correct_result()
    {
        $user = User::factory()->create(['role' => 'admin'])->fresh();

        $this->assertTrue($user->isAdmin());
    }

    public function test_client_user_detail_return_client_detail_model()
    {
        $user = User::factory()->create(['role' => 'client'])->fresh();

        $this->assertInstanceOf(ClientDetail::class, $user->detail);
    }

    public function test_counsellor_user_detail_return_counsellor_detail_model()
    {
        $user = User::factory()->create(['role' => 'counsellor'])->fresh();

        $this->assertInstanceOf(CounsellorDetail::class, $user->detail);
    }

    public function test_admin_user_detail_return_admin_detail_model()
    {
        $user = User::factory()->create(['role' => 'admin'])->fresh();

        $this->assertInstanceOf(AdminDetail::class, $user->detail);
    }
}
