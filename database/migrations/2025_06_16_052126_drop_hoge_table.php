<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //削除
        Schema::dropIfExists('category_compatibles');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('category_compatibles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }
};
