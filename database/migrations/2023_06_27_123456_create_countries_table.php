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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->char('iso', 2)->unique();
            $table->string('name', 80)->unique();
            $table->string('nicename', 80)->unique();
            $table->char('iso3', 3)->nullable()->unique();
            $table->smallInteger('numcode')->nullable();
            $table->integer('phonecode');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
