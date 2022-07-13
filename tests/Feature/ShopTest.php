<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\User;
use App\models\Area;
use App\models\Shop;
use App\models\Category;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Database\Seeders\ShopsTableSeeder;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ShopTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_index()
    {
        $response = $this->get('/');
        $response->assertViewIs('index');
        $response->assertViewHas(['shops', 'areas', 'categories', 'area_id', 'category_id', 'keyword']);
        $response->assertStatus(200);
    }

    public function test_detail()
    {
        Area::factory()->create();
        Category::factory()->create();
        User::factory()
            ->state(new Sequence(
                ['role' => 2],
            ))
            ->create();
        Shop::factory()->create();
        $response = $this->get('/detail/1');
        $response->assertViewIs('detail');
        $response->assertViewHas(['shops', 'courses']);
        $response->assertStatus(200);
    }

    public function test_search()
    {
        Area::factory()->create();
        Category::factory()->create();
        User::factory()
            ->state(new Sequence(
                ['role' => 2],
            ))
            ->create();
        Shop::factory()->create([
            'area_id' => 2,
            'category_id' => 2,
            'owner_id' => 2,
        ]);
        $response = $this->get('/search', [
            'area_id' => 2,
            'category_id' => 2,
            'keyword' => '仙人',
        ]);
        $response->assertViewIs('index');
        $response->assertViewHas(['shops', 'areas', 'categories', 'area_id', 'category_id', 'keyword']);
        $response->assertStatus(200);
    }

    public function test_add()
    {
        Area::factory()->create();
        Category::factory()->create();
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 2],
            ))
            ->create();
        $this->actingAs($user);
        Storage::fake('local');
        $data = [
            "area_id" => 3,
            "category_id" => 3,
            "owner_id" => 3,
            "name" => 'example',
            "overview" => 'example',
            "image_path" => UploadedFile::fake()->image('example.jpg'),
        ];
        $response = $this->post('/shop/add', $data);
        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('shops',['name' => 'example']);
        Storage::disk('local')->assertExists('public/images/example.jpg');
    }

    public function test_update()
    {
        Area::factory()->create();
        Category::factory()->create();
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 2],
            ))
            ->create();
        $this->actingAs($user);
        Shop::factory()->create([
            'area_id' => 4,
            'category_id' => 4,
            'owner_id' => 4,
        ]);
        Storage::fake('local');
        $data = [
            "area_id" => 4,
            "category_id" => 4,
            "owner_id" => 4,
            "name" => 'updated',
            "overview" => 'updated',
            "image_path" => UploadedFile::fake()->image('update.jpg'),
        ];
        Storage::disk('local')->assertMissing('public/images/update.jpg');
        $response = $this->post('/shop/update/4', $data);
        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('shops',['name' => 'updated']);
        Storage::disk('local')->assertExists('public/images/update.jpg');
    }
}
