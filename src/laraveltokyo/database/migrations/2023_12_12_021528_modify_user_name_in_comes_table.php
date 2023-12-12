<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserNameInComesTable extends Migration
{
    public function up()
    {
        Schema::table('comes', function (Blueprint $table) {
            $table->dropColumn('user_id'); // user_idカラムを削除
            $table->string('user_name')->default('匿名'); // user_nameカラムを追加
        });
    }

    public function down()
    {
        Schema::table('comes', function (Blueprint $table) {
            $table->integer('user_id'); // user_idカラムを復元
            $table->dropColumn('user_name'); // user_nameカラムを削除
        });
    }
}
