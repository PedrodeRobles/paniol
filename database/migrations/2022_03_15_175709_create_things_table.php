<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('things', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();

            $table->string('name');
            $table->integer('state')->default(1);
            $table->string('identifier');
            $table->text('description')->nullable();
            // $table->integer('place');
            $table->integer('visibility')->default(1);

            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('things');
    }
}
