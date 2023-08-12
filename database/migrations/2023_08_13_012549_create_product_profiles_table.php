<?php

use App\Models\Product;
use App\Models\Profile;
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
        Schema::create('product_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(Profile::class)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_profiles');
    }
};
