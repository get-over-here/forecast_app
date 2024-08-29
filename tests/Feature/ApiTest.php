<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_making_a_show_request(): void
    {
        $response = $this->getJson('/api/v1/show?location=London&startDate=946695600&endDate=946749600');
        $response->assertStatus(200);
    }

}
