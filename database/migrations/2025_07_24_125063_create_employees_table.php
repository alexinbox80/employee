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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('division_id')->unsigned()->nullable();
            $table->foreign('division_id')->references('id')->on('divisions');

            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('middle_name', 128);

            $table->string('email', 128)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address', 256);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
