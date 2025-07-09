<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->insert([
            ['featureID' => 'F001', 'featureName' => 'GPS', 'featureDescription' => 'Sistema de navegación', 'priceImpact' => 5.00],
            ['featureID' => 'F002', 'featureName' => 'Asientos Piel', 'featureDescription' => 'Tapicería de piel', 'priceImpact' => 10.00],
        ]);
    }
}
