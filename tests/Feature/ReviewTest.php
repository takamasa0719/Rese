<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Area;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReviewTest extends TestCase
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
        Area::factory()->create();
        Category::factory()->create();
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 3],
            ))
            ->create();
        $this->actingAs($user);
    }

    public function test_review()
    {
        Shop::factory()->create([
            'area_id' => 8,
            'category_id' => 8,
            'owner_id' => 11,
        ]);
        $data = [
            "user_id" => 11,
            "shop_id" => 5,
            "rating" => 3,
            "review" => 'example',
        ];
        $response = $this->assertDatabaseMissing('reviews', $data);
        $response = $this->post('/review/1', $data);

        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('reviews', $data);
    }

    public function test_update()
    {
        Shop::factory()->create([
            'area_id' => 9,
            'category_id' => 9,
            'owner_id' => 12,
        ]);
        Review::factory()->create([
            "user_id" => 12,
            "shop_id" => 6,
            'rating' => 2,
            'review' => 'example',
        ]);
        $data = [
            "user_id" => 12,
            "shop_id" => 6,
            "rating" => 3,
            "review" => 'updated',
        ];
        $response = $this->assertDatabaseMissing('reviews', $data);
        $response = $this->post('/review/update/2', $data);
        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('reviews', $data);
    }
}
