<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimestampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timestamps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('punchIn');
            $table->dateTime('punchOut')->nullable();
            $table->integer('work_id')->unsigned()->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('work_id')->references('id')->on('work');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timestamps');
    }
}
