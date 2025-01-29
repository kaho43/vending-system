<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    

    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('id', true, true)->change(); // id を int に変更
            $table->integer('company_id')->change(); // company_id を int に変更
            $table->string('product_name')->change(); // product_name はそのままで変更しない
            $table->integer('price')->change(); // price を int に変更
            $table->integer('stock')->change();
            $table->text('comment')->nullable()->change(); // comment を text に変更
            $table->string('image_path')->nullable()->change(); // img_path を変更
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable(false)->change(); // created_at を NOT NULL に変更
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable(false)->change(); // updated_at を NOT NULL に変更
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
           // ダウンメソッドで元の状態に戻す
           $table->bigIncrements('id')->change();
           $table->string('company_id')->nullable()->change();
           $table->string('product_name')->change();
           $table->decimal('price', 8, 2)->change();
           $table->integer('stock')->change();
           $table->string('comment')->nullable()->change();
           $table->string('image_path')->nullable()->change();
           $table->timestamp('created_at')->nullable()->change(); // created_at を nullable に戻す
           $table->timestamp('updated_at')->nullable()->change(); // updated_at を nullable に戻す 
        });
    }
};
