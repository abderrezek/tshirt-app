<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClothesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clothes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->json('size');
            $table->integer('qte');
            $table->boolean('is_enabled')->default(true);
            $table->integer('nb_added');
            $table->json('colors');
            $table->float('price');
            $table->boolean('is_sale');
            $table->float('sale')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('clothes');
    }
}
