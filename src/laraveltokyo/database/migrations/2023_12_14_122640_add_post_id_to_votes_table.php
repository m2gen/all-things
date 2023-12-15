<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign(['post_id']); // 外部キー制約を削除
            $table->dropColumn('post_id'); // post_idカラムを削除
        });
    }
};
