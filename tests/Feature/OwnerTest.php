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
use Illuminate\Support\Facades\Hash;

class OwnerTest extends TestCase
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
    }
    
    public function test_index()
    {
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 2],
            ))
            ->create();
        $this->actingAs($user);
        $response = $this->get('/owner');
        $response->assertStatus(200);
        $response->assertViewIs('owner');
        $response->assertViewHas(['shop', 'reservations', 'areas',  'categories']);
    }

    public function test_owner_create()
    {
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 1],
            ))
            ->create();
        $this->actingAs($user);
        $data = [
            "name" => 'example',
            "email" => 'test_example.com',
            "password" => 'password',
            "role" => '2'
        ];
        $response = $this->assertDatabaseMissing('users', [
            "name" => 'example',
            "email" => 'test_example.com',
            "role" => '2'
        ]);
        $response = $this->post('/owner/add', $data);

        $response->assertStatus(302);
        $response = $this->assertDatabaseHas('users', [
            "name" => 'example',
            "email" => 'test_example.com',
            "role" => '2'
        ]);
    }

    public function test_owner_delete()
    {
        $user = User::factory()
            ->state(new Sequence(
                ['role' => 1],
            ))
            ->create();
        $this->actingAs($user);
        User::factory()
            ->state(new Sequence(
                ['role' => 2],
            ))
            ->create();
        $response = $this->assertDatabaseHas('users',['id' => 4]);
        $response = $this->post('/owner/delete/4');
        $response->assertStatus(302);
        $response = $this->assertDatabaseMissing('users',['id' => 4]);
    }
}
