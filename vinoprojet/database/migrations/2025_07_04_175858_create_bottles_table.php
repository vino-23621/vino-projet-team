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
        Schema::create('bottles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->json('grape_variety')->nullable();
            $table->string('appellation')->nullable();
            $table->float('alcohol_percentage', 4, 2)->nullable();
            $table->float('sugar', 4, 1)->nullable();
            $table->integer('size')->nullable();

            $table->unsignedBigInteger('identity_id');
            $table->foreign('identity_id')->references('id')->on('identities');

            $table->year('vintage')->nullable();

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bottles');
    }
};
