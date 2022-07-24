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
            'area_id' => 1,
            'category_id' => 1,
            'owner_id' => 1,
        ]);
        $data = [
            "user_id" => 1,
            "shop_id" => 1,
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
            'area_id' => 2,
            'category_id' => 2,
            'owner_id' => 2,
        ]);
        Review::factory()->create([
            "user_id" => 2,
            "shop_id" => 2,
            'rating' => 2,
            'review' => 'example',
        ]);
        $data = [
            "user_id" => 2,
            "shop_id" => 2,
            "rating" => 3,
            "review" => 'updated',
        ];
        $response = $this->assertDatabaseMissing('reviews', $data);
        $response = $this->post('/review/update/2', $data);
        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('reviews', $data);
    }
}
