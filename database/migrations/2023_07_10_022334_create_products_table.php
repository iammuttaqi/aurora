<?php

use App\Models\ProductCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('manufacturer_id')->constrained('profiles');
            $table->foreignIdFor(ProductCategory::class, 'product_category_id')->constrained();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->string('serial_number')->unique();
            $table->binary('qr_code')->nullable()->unique();
            $table->integer('warranty_period')->nullable();
            $table->enum('warranty_period_unit', ['days', 'weeks', 'months', 'years'])->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
