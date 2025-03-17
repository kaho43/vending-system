<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            // セッションID（主キー）
            $table->string('id')->primary();
            
            // ユーザーID（オプションでユーザーが関連する場合）
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // セッションデータ（ペイロード）
            $table->text('payload');

            // 最後のアクティビティ時刻
            $table->integer('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // セッションテーブルを削除
        Schema::dropIfExists('sessions');
    }
}
