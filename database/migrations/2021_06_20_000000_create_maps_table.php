<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('maps')) {
            Schema::create('maps', function (Blueprint $table) {
                $table->id();
                $table->integer('postal');
                $table->string('city');
                $table->string('district');
                $table->string('road');
                $table->float('lat')->nullable();
                $table->float('lon')->nullable();
                $table->float('distance')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maps');
    }
}
