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
            // すでに `id` カラムがある場合は処理しない
            if (!Schema::hasColumn('sales', 'id')) {
                $table->bigIncrements('id')->first(); // `bigIncrements` に統一
            }
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
            // `id` を元の `increments` に戻す
            if (Schema::hasColumn('sales', 'id')) {
                $table->dropColumn('id'); // まず削除
                $table->increments('id')->first(); // 再追加
            }
        });
    }
}
