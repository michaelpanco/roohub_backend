<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128) -> unique();
            $table->string('nickname', 32) -> nullable();
            $table->float('weight');
            $table->float('height');
            $table->enum('gender', ['male', 'female']);
            $table->string('color', 64) -> nullable();
            $table->enum('friendliness', ['friendly', 'not-friendly']) -> nullable();;
            $table->date('birthday');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
