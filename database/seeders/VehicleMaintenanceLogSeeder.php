<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleMaintenanceLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_maintenance_logs')->insert([
            [
                'VehicleID' => 1,
                'maintenanceType' => 'Aceite/Filtro',
                'costOfMaintenance' => 80.00,
                'lastMaintenanceDate' => '2024-06-15',
                'nextServiceDueKM' => 100000,
                'nextServiceDueDate' => '2024-12-15',
                'mechanicName' => 'Taller X',
                'mechanicContact' => '555-9000',
            ],
        ]);
    }
}
