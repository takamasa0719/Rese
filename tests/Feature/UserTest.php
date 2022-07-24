<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_mypage()
    {
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 3],
            ))
            ->create();
        $this->actingAs($user);
        $response = $this->get('/mypage');
        $response->assertViewIs('mypage');
        $response->assertViewHas(['shops', 'reservations', 'doneReservations']);
        $response->assertStatus(200);
    }

    public function test_admin()
    {
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 1],
            ))
            ->create();
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertViewIs('admin');
        $response->assertViewHas('owners');
        $response->assertStatus(200);
    }
}
