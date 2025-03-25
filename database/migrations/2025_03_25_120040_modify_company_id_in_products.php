<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCompanyIdInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // まず、companiesテーブルのidカラムをunsignedBigIntegerに変更
        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change(); // unsignedBigIntegerに変更
        });

        // 次に、productsテーブルのcompany_idを変更
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->change(); // company_idをunsignedBigIntegerに変更
            // 外部キー制約の追加
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
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
            $table->integer('id')->change(); // 元のinteger型に戻す
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('company_id')->nullable()->change(); // company_idをstringに戻す
            $table->dropForeign(['company_id']); // 外部キー制約を削除
        });
    }
}
