<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('vehicles')->insert([
            ['make' => 'Toyota', 'model' => 'Corolla', 'year' => 2022, 'licensePlate' => 'ABC-123'],
            ['make' => 'Ford', 'model' => 'Focus', 'year' => 2021, 'licensePlate' => 'DEF-456'],
        ]);
    }
}
