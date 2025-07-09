<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleFeatureAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('vehicle_feature_assignments')->insert([
            ['VehicleID' => 1, 'FeatureID' => 'F001'],
            ['VehicleID' => 1, 'FeatureID' => 'F002'],
        ]);
    }
}
