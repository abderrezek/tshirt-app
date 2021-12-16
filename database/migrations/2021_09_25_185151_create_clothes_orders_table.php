<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClothesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clothes_orders', function (Blueprint $table) {
            $table->id();

            $table->integer('nb_clothe');
            $table->float('price_total_clothe');
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('clothe_id')
                ->constrained('clothes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('clothes_orders');
    }
}
