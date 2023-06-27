<?php

use App\Models\City;
use App\Models\EmployeeRange;
use App\Models\User;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'user_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Primary data for both Manufacturers and Shops
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('contact_person')->nullable();
            $table->text('address')->nullable();
            $table->foreignIdFor(City::class, 'city_id')->nullable();
            $table->string('contact_number_1')->nullable();
            $table->string('contact_number_2')->nullable();
            $table->string('contact_number_3')->nullable();
            $table->string('email_1')->nullable();
            $table->string('email_2')->nullable();
            $table->string('email_3')->nullable();
            $table->string('website')->nullable();
            $table->longText('about')->nullable();
            $table->string('logo')->nullable();
            $table->string('map_link')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();

            // Additional fields
            $table->text('category_ids')->nullable();
            $table->foreignIdFor(EmployeeRange::class, 'employee_range_id')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('business_license')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('shipping_options')->nullable();
            $table->longText('additional_information')->nullable();

            // Manufacturer-specific data
            $table->string('general_manager_name')->nullable();
            $table->string('general_manager_email')->nullable();
            $table->string('sales_manager_name')->nullable();
            $table->string('sales_manager_email')->nullable();
            $table->string('hr_manager_name')->nullable();
            $table->string('hr_manager_email')->nullable();
            $table->string('it_manager_name')->nullable();
            $table->string('it_manager_email')->nullable();
            $table->text('manufacturing_capabilities')->nullable();
            $table->text('certifications')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
