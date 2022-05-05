<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->foreignId('map_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('address');
            $table->text('mobile');
            $table->json('payment')->default(json_encode(['method' => null, 'id' => null]));
            $table->text('message')->nullable();
            $table->integer('fee')->default(0);
            $table->enum('status', ['PENDING', 'CHECKED', 'PAID', 'ARRIVED'])->default('PENDING');
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
        Schema::dropIfExists('orders');
    }
}
