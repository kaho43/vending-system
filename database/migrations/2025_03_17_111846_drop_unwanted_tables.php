<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUnwantedTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('sessions');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //
    }
};
