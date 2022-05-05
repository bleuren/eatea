<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained();
            $table->unique(["order_id", "product_id", "mode"], 'order_product_unique');
            $table->enum('mode', ['SUBSCRIBE', 'PICKUP', 'DELIVERY'])->default('SUBSCRIBE');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropUnique('order_product_unique');
        });
    }
}
