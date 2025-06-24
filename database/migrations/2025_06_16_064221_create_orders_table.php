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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('base_id');
            $table->unsignedBigInteger('factory_id');
            $table->unsignedBigInteger('account_id');
            $table->string("order_at");
            $table->string("sum_amout");
            $table->timestamps();

            $table->foreign('base_id')->references('id')->on('base')->onDelete('cascade');
            $table->foreign('factory_id')->references('id')->on('factory')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
