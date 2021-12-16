<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarqueIdColumnTableClothes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("clothes", function ($table) {
            $table->foreignId('marque_id')
                ->nullable()
                ->constrained('marques')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clothes', function ($table) {
            $table->dropColumn('margue_id');
        });
    }
}
