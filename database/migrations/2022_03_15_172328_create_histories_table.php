<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\History;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();

            $table->string('user');
            $table->string('person_name');
            $table->string('person_last_name');
            $table->string('identifier');

            $table->timestamps();
        });

        History::create([
            'user'             => 'ADMIN',
            'person_name'      => 'ADMIN',
            'person_last_name' => 'ADMIN',
            'identifier'       => 'DEFAULT'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
