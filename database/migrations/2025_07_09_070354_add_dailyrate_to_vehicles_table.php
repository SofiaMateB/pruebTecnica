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
      Schema::table('vehicles', function (Blueprint $table) {
        $table->decimal('dailyRate', 10, 2)->default(50); // o el valor que quieras
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    Schema::table('vehicles', function (Blueprint $table) {
        $table->dropColumn('dailyRate');
    });
    }
};
