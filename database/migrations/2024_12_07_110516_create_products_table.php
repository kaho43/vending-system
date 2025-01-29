<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id(); // 主キー
                $table->string('name'); // 商品名
                $table->decimal('price', 8, 2); // 価格
                $table->integer('stock');//在庫数
                $table->string('company_id')->nullable();// メーカー名
                $table->string('image_path')->nullable();
                $table->timestamps(); // created_at と updated_at

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            });
        }    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
