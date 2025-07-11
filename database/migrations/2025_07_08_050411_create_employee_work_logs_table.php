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
        Schema::create('employee_work_logs', function (Blueprint $table) {
           $table->id('LogID');
            $table->foreignId('EmployeeID')->constrained('employees', 'EmployeeID');
           $table->foreignId('BranchID')->constrained('branches', 'BranchID');
            $table->date('DateWorked');
            $table->integer('HoursWorked');
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
        Schema::dropIfExists('employee_work_logs');
    }
};
