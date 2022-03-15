<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryThingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_thing', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('history_id')->unsigned();
            $table->bigInteger('thing_id')->unsigned();

            $table->timestamps();

            $table->foreign('history_id')->references('id')->on('histories');
            $table->foreign('thing_id')->references('id')->on('things');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_thing');
    }
}
