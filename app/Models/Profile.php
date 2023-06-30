<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved',
        'name',
        'username',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function employeeRange()
    {
        return $this->belongsTo(EmployeeRange::class);
    }

    public $default_logo = 'assets/default.png';

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => $value && file_exists($value) ? $value : $this->default_logo,
        );
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            set: fn () => $this->generateUniqueUsername(),
        );
    }

    private function generateUniqueUsername()
    {
        if (!$this->username) {
            $username = str()->slug($this->name);
            $count    = 2;

            while ($this->where('username', $username)->exists()) {
                $username = str()->slug($this->name) . '-' . $count++;
            }

            return $username;
        }

        return $this->username;
    }
}
