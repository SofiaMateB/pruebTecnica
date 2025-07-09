<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecommendedRateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testRecommendedRateReturnsCorrectStructure()
    {
        $vehicle = Vehicle::factory()->create([
            'dailyRate' => 100,
            'year' => now()->year - 2,
            'mileage' => 50000,
        ]);

        $response = $this->getJson("/api/vehicles/{$vehicle->VehicleID}/recommended-rate?start_date=2025-07-15&end_date=2025-07-20");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'recommended_daily_rate',
            'original_rate',
        ]);
    }
            public function testRecommendedRateForInvalidVehicleReturnsNotFound()
        {
            $response = $this->getJson("/api/vehicles/999/recommended-rate?start_date=2025-07-15&end_date=2025-07-20");

            $response->assertStatus(404);
        }
}
