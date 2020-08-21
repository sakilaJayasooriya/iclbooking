<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColmnsToStartingCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('starting_cities', function (Blueprint $table) {
            $table->text('weather')->nullable();
            $table->text('population')->nullable();
            $table->text('mayor')->nullable();
            $table->text('municipality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('starting_cities', function (Blueprint $table) {
            $table->dropColumn('weather');
            $table->dropColumn('population');
            $table->dropColumn('mayor');
            $table->dropColumn('municipality');
        });
    }
}
