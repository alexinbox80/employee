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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();

            $table->string('level0_full', 256);
            $table->string('level0_short', 256);
            $table->string('level1_full', 256);
            $table->string('level1_short', 256);
            $table->string('level2_full', 256)->nullable();
            $table->string('level2_short', 256)->nullable();
            $table->string('level3_full', 256)->nullable();
            $table->string('level3_short', 256)->nullable();
            $table->string('level4_full', 256)->nullable();
            $table->string('level4_short', 256)->nullable();
            $table->string('level5_full', 256)->nullable();
            $table->string('level5_short', 256)->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
