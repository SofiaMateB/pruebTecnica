<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
             $this->call([
                CustomersTableSeeder::class,
                VehiclesTableSeeder::class,
                EmployeesTableSeeder::class,
                BranchesTableSeeder::class,
                RentalsTableSeeder::class,
                VehicleMaintenanceLogSeeder::class,
                EmployeeWorkLogSeeder::class,
                FeaturesTableSeeder::class,
                VehicleFeatureAssignmentSeeder::class,
                CustomerFeedbackSeeder::class,
            ]);
    }
}
