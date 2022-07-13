<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThanksTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_thanks()
    {
        $response = $this->get('/thanks');
        $response->assertViewIs('thanks');
        $response->assertStatus(200);
    }
}
