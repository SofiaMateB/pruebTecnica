<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeWorkLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('employee_work_logs')->insert([
            ['EmployeeID' => 1, 'BranchID' => 1, 'dateWorked' => '2024-07-01', 'hoursWorked' => 8],
            ['EmployeeID' => 2, 'BranchID' => 2, 'dateWorked' => '2024-07-01', 'hoursWorked' => 9],
        ]);
    }
}
