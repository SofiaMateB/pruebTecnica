<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('RentalID');
            $table->foreignId('CustomerID')->constrained('customers', 'CustomerID');
            $table->foreignId('VehicleID')->constrained('vehicles', 'VehicleID');
            $table->foreignId('EmployeeID')->constrained('employees', 'EmployeeID');
             $table->foreignId('BranchID')->constrained('branches', 'BranchID');
            $table->date('RentalDate');
            $table->date('ReturnDate');
            $table->decimal('DailyRate', 10, 2);
            $table->decimal('TotalAmountPaid', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};
