<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            ['name' => 'Ana García', 'email' => 'ana@mail.com', 'phone' => '555-1234'],
            ['name' => 'Juan Pérez', 'email' => 'juan@mail.com', 'phone' => '555-5678'],
        ]);
    }
}
