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
        Schema::create('customer_feedback', function (Blueprint $table) {
            $table->string('FeedbackID', 10)->primary();
            $table->foreignId('CustomerID')->constrained('customers', 'CustomerID');
            $table->foreignId('RentalID')->constrained('rentals', 'RentalID');
            $table->integer('Rating');
            $table->text('Comments');
            $table->date('FeedbackDate');
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
        Schema::dropIfExists('customer_feedback');
    }
};
