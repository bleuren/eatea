<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')
                ->constrained()
                ->onDelete('cascade');
            $table->date('received_at');
            $table->integer('qty')->default(1);
            $table->unique(["order_item_id", "received_at"], 'order_item_received_unique');
            $table->enum('status', ['PENDING', 'ARRIVED', 'UNCLAIMED'])->default('PENDING');
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
        Schema::table('order_item_subs', function (Blueprint $table) {
            $table->dropUnique('order_item_received_unique');
        });
    }
}
