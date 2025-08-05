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
        Schema::create('cellar__has__bottles', function (Blueprint $table) {
            $table->unsignedBigInteger('cellar_id');
            $table->unsignedBigInteger('bottle_id');
            $table->integer('quantity')->default(0);

            $table->timestamps();

            $table->primary(['cellar_id', 'bottle_id']);

            $table->foreign('cellar_id')->references('id')->on('cellars');
            $table->foreign('bottle_id')->references('id')->on('bottles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cellar__has__bottles');
    }
};
