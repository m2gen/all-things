<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComePostTable extends Migration
{
    public function up()
    {
        Schema::create('come_post', function (Blueprint $table) {
            $table->id();
            $table->integer('come_id');
            $table->integer('post_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('come_post');
    }
}
