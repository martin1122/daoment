<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('index_id')->unsigned();
            $table->foreign('index_id')->references('id')->on('indices')->onDelete('cascade');
            $table->float('value', 12, 2);
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
        Schema::dropIfExists('index_values');
    }
}
