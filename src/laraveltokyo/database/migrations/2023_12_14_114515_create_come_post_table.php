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
            $table->foreignId('come_id')->constrained('comes')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('come_post');
    }
}
