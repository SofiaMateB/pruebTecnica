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
        Schema::create('vehicle_maintenance_logs', function (Blueprint $table) {
            $table->id('MaintenanceID');
            $table->foreignId('VehicleID')->constrained('vehicles', 'VehicleID');
            $table->string('MaintenanceType', 100);
            $table->decimal('CostOfMaintenance', 10, 2);
            $table->date('LastMaintenanceDate');
            $table->integer('NextServiceDueKM');
            $table->date('NextServiceDueDate');
            $table->string('MechanicName', 100);
            $table->string('MechanicContact', 20);
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
        Schema::dropIfExists('vehicle_maintenance_logs');
    }
};
