<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

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
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('person_id')->unsigned();

            $table->string('identifier');
            $table->integer('return')->default(1);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('person_id')->references('id')->on('people');
        });

        Order::create([
            'user_id'    => 1,
            'person_id'  => 1,
            'identifier' => 'ADMIN',
        ]);

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
