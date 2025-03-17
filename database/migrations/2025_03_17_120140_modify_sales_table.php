<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            // id を int 型に変更（auto_increment と unsigned）
            $table->bigIncrements('id')->change();

            // product_id を bigint から int に変更
            $table->integer('product_id')->unsigned()->change();

            // created_at と updated_at を NOT NULL に変更
            $table->timestamp('created_at')->useCurrent()->nullable(false)->change();
            $table->timestamp('updated_at')->useCurrent()->nullable(false)->change();
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
            // 変更を元に戻す
            $table->bigIncrements('id')->change();
            $table->bigInteger('product_id')->unsigned()->change();
            $table->timestamp('created_at')->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }
}
