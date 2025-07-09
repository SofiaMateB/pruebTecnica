<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('rentals')->insert([
            [
                'CustomerID' => 1,
                'VehicleID' => 1,
                'EmployeeID' => 1,
                'BranchID' => 1,
                'rentalDate' => '2024-07-01',
                'returnDate' => '2024-07-05',
                'dailyRate' => 45.00,
                'totalAmountPaid' => 180.00,
            ],
            [
                'CustomerID' => 2,
                'VehicleID' => 2,
                'EmployeeID' => 2,
                'BranchID' => 2,
                'rentalDate' => '2024-07-02',
                'returnDate' => '2024-07-04',
                'dailyRate' => 50.00,
                'totalAmountPaid' => 100.00,
            ],
        ]);
    }
}
