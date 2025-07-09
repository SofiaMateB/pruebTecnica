<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('customer_feedback')->insert([
            [
                'FeedbackID' => 'FB001',
                'CustomerID' => 1,
                'RentalID' => 1,
                'rating' => 5,
                'comments' => 'Muy buen servicio',
                'feedbackDate' => '2024-07-06',
            ],
        ]);

    }
}
