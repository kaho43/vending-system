<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySalesTableId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            // 現在の id を削除
            $table->dropColumn('id');
            
            // 新しい int 型の id を追加
            $table->increments('id')->unsigned()->first(); // オートインクリメントとして設定
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            // id カラムを再度 bigint 型で追加
            $table->bigIncrements('id')->unsigned()->first();
        });
    }
}
