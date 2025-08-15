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
        Schema::table('bottles', function (Blueprint $table) {
            $table->json('grape_variety')->nullable()->after('price');
            $table->string('appellation')->nullable()->after('grape_variety');
            $table->float('alcohol_percentage', 4, 2)->nullable()->after('appellation');
            $table->float('sugar', 4, 1)->nullable()->after('alcohol_percentage');
        });
    }


    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('bottles', function (Blueprint $table) {
            $table->dropColumn([
                'grape_variety',
                'appellation',
                'alcohol_percentage',
                'sugar',
            ]);
        });
    }
};
