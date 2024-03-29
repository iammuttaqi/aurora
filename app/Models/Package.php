<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'popular'  => 'boolean',
        'title'    => 'string',
        'details'  => 'string',
        'price'    => 'integer',
        'features' => 'array',
    ];

    public function profile_packages()
    {
        return $this->hasMany(ProfilePackage::class);
    }
}
