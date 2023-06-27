<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        'name',
        'contact_person',
        'address',
        'city_id',
        'contact_number_1',
        'contact_number_2',
        'contact_number_3',
        'email_1',
        'email_2',
        'email_3',
        'website',
        'about',
        'logo',
        'map_link',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',

        'category_ids',
        'employee_range_id',
        'tax_number',
        'business_license',
        'vat_number',
        'payment_terms',
        'shipping_options',
        'additional_information',

        'general_manager_name',
        'general_manager_email',
        'sales_manager_name',
        'sales_manager_email',
        'hr_manager_name',
        'hr_manager_email',
        'it_manager_name',
        'it_manager_email',
        'manufacturing_capabilities',
        'certifications',
    ];

    protected $casts = [
        'category_ids' => 'array',
    ];
}
