<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('street_address')->nullable();
            $table->string('representative_name')->nullable();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('companies');
    }   

}
