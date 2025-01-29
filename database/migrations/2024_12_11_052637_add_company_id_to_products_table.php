<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToProductsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('products', 'company_id')) {
        // company_id を追加し、company_name を削除
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('company_id')->nullable()->after('id');
                $table->dropColumn('company_name');  // company_name カラムを削除
            });

        // company_id に外部キー制約を追加
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }
}    

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // 外部キーが存在する場合のみ削除
            if (Schema::hasColumn('products', 'company_id')) {
                $table->dropColumn(['company_id']); // 外部キー制約を削除
            }
        });
    }

}
