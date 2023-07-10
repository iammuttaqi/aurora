<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function manufacturer()
    {
        return $this->belongsTo(Profile::class);
    }

    public function shops()
    {
        return $this->belongsToMany(Profile::class, 'product_shops', 'product_id', 'shop_id')->withTimestamps();
    }
}
