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
        Schema::create('vehicle_feature_assignments', function (Blueprint $table) {
            $table->foreignId('VehicleID')->constrained('vehicles', 'VehicleID');
            $table->string('FeatureID', 10);
            $table->primary(['VehicleID', 'FeatureID']);
            $table->foreign('FeatureID')->references('FeatureID')->on('features');
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
        Schema::dropIfExists('vehicle_feature_assignments');
    }
};
