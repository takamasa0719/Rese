<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\User;
use App\models\Area;
use App\models\Shop;
use App\models\Category;
use App\models\Favorite;
use Illuminate\Database\Eloquent\Factories\Sequence;

class FavoriteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    protected function setup(): void
    {
        parent::setup();
        Area::factory()->create();
        Category::factory()->create();
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 3],
            ))
            ->create();
        $this->actingAs($user);
    }

    public function test_create()
    {
        Shop::factory()->create([
            'area_id' => 1,
            'category_id' => 1,
            'owner_id' => 1,
        ]);
        $data = [
            "shop_id" => 1,
        ];
        $response = $this->assertDatabaseMissing('favorites', $data);
        $response = $this->post('/favorite/1', $data);

        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('favorites', $data);
    }

    public function test_unfavorite()
    {
        Shop::factory()->create([
            'area_id' => 2,
            'category_id' => 2,
            'owner_id' => 2,
        ]);
        Favorite::factory()->create([
            'shop_id' => 2,
            'user_id' => 2,
        ]);
        $response = $this->assertDatabaseHas('favorites',['id' => 2]);
        $response = $this->post('/favorite/delete/2');
        $response->assertStatus(302);
        $response = $this->assertDatabaseMissing('favorites',['id' => 2]);
    }
}
