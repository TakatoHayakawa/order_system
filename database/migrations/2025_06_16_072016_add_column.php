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
        Schema::table('arrival_details', function (Blueprint $table) {
            // カラム追加
            $table->bigInteger('arrival_id')->unsigned()->after('id');
            // カラムの外部キー制約追加
            $table->foreign('arrival_id')->references('id')->on('arrival')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrival_details', function (Blueprint $table) {
            //
        });
    }
};
