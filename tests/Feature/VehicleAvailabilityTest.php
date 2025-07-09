<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleAvailabilityTest extends TestCase
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
    public function testAvailableVehiclesReturnsSuccessResponse()
    {
        $response = $this->getJson('/api/vehicles/available?start_date=2025-07-15&end_date=2025-07-20');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['VehicleID', 'Make', 'Model', 'Year', 'LicensePlate'] // ajusta a tu estructura
        ]);
    }

    public function testAvailableVehiclesWithInvalidDatesReturnsError()
    {
            $response = $this->getJson('/api/vehicles/available?start_date=2020-01-01&end_date=2025-07-20');

            $response->assertStatus(422);
            $response->assertJsonValidationErrors(['start_date']);
        }
}
