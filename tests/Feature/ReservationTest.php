<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Area;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Course;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReservationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 3],
            ))
        ->create();
        $this->actingAs($user);
    }

    public function test_done()
    {
        $response = $this->get('/done');
        $response->assertViewIs('reserved');
        $response->assertStatus(200);
    }

    public function test_reserve()
    {
        Area::factory()->create();
        Category::factory()->create();
        Shop::factory()->create([
            'area_id' => 6,
            'category_id' => 6,
            'owner_id' => 9,
        ]);
        Course::factory()->create([
            'shop_id' => 3,
            'name' => 'コースB',
            'amount' => '3500',
        ]);
        $data = [
            'name' => 'example',
            'date' => '2024-01-01',
            'time' => '12:30',
            'number' => 1,
            'shop_id' => 1,
            'course_id' => 1,
        ];
        $response = $this->call('GET', '/reserve', $data);
        $response->assertStatus(200);
        $response->assertViewIs('payment');
    }
    public function test_update()
    {
        Area::factory()->create();
        Category::factory()->create();
        Shop::factory()->create([
            'area_id' => 7,
            'category_id' => 7,
            'owner_id' => 10,
        ]);
        Course::factory()->create([
            'shop_id' => 4,
            'name' => 'コースB',
            'amount' => '3500',
        ]);
        Reservation::factory()->create([
            'date' => '2024-01-01',
            'time' => '11:30',
            'number' => 1,
            'user_id' => 10,
            'shop_id' => 4,
            'course_id' => 2,
        ]);
        $data = [
            'date' => '2024-01-01',
            'time' => '12:30',
            'number' => 3,
            'user_id' => 10,
            'shop_id' => 4,
        ];
        $response = $this->assertDatabaseMissing('reservations', $data);
        $response = $this->post('/reserve/update/1', $data);
        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('reservations', $data);
    }
}
