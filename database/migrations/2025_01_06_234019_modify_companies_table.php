<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            // id カラムを int 型に変更（自動インクリメント）
            $table->integer('id')->autoIncrement()->change();  // AUTO_INCREMENTを変更

            // その他のカラムの変更
            $table->string('company_name')->change();
            $table->string('street_address')->nullable()->change();
            $table->string('representative_name')->nullable()->change();
            $table->timestamp('created_at')->nullable(false)->change();
            // updated_at に CURRENT_TIMESTAMP をデフォルトに設定
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            // id カラムを bigint 型に戻す
            $table->bigInteger('id')->autoIncrement()->change();  // AUTO_INCREMENTを戻す

            // その他のカラムを戻す
            $table->string('company_name')->nullable()->change();
            $table->string('street_address')->nullable()->change();
            $table->string('representative_name')->nullable()->change();
            $table->timestamp('created_at')->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }
}
