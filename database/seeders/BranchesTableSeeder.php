<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            ['location' => 'Centro', 'address' => 'Calle Sol 123', 'phone' => '931-111-222'],
            ['location' => 'Norte', 'address' => 'Av. Luna 456', 'phone' => '932-333-444'],
        ]);
    }
}
