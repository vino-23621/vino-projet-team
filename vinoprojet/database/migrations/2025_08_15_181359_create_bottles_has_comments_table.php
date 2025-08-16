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
        Schema::create('bottles_has_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bottle_id');
            $table->unsignedBigInteger('comment_id');
            $table->text('comment');
            $table->unsignedTinyInteger('notation')->default(0);
            $table->timestamps();

            $table->foreign('bottle_id')->references('id')->on('bottles')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bottles_has_comments');
    }
};
