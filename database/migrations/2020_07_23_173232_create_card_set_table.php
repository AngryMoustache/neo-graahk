<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_set', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained();
            $table->foreignId('set_id')->constrained();
            $table->boolean('reprint')->default(0);
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(['set_id']);
            $table->dropColumn('set_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_set');

        Schema::table('cards', function (Blueprint $table) {
            $table->foreignId('set_id')->constrained();
        });
    }
}
