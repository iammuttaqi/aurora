<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $default_image = 'assets/no-image.png';

    protected function checkable(): Attribute
    {
        return Attribute::make(
            get: fn () => auth()->user()->role->slug == 'manufacturer' && $this->product_shop ? false : true,
        );
    }

    private function isOwner()
    {
        $shop                = $this->product_shops->where('shop_id', auth()->user()->profile->id)->first();
        $latest_product_shop = $this->product_shops()->latest()->first();

        return $shop->created_at == $latest_product_shop->created_at;
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn () => fake()->imageUrl,
            get: fn (?string $value) => $value ? $value : $this->default_image,
        );
    }

    protected function serialNumber(): Attribute
    {
        return Attribute::make(
            set: fn () => $this->generateSerialNumber(),
        );
    }

    private function generateSerialNumber()
    {
        try {
            $serial_number = fake()->unique()->numerify('SN-########');

            while ($this->where('serial_number', $serial_number)->exists()) {
                $serial_number = fake()->unique()->numerify('SN-########');
            }

            return $serial_number;
        } catch (\Throwable $th) {
            logger(__METHOD__, [$th]);

            return null;
            throw $th;
        }
    }

    protected function qrCode(): Attribute
    {
        return Attribute::make(
            set: fn () => $this->generateQrCode(),
        );
    }

    private function generateQrCode()
    {
        try {
            $url = URL::signedRoute('verify_identity_product', $this->serial_number);

            return QrCode::size(500)->generate($url);
        } catch (\Throwable $th) {
            logger(__METHOD__, [$th]);

            return null;
            throw $th;
        }
    }

    public function manufacturer()
    {
        return $this->belongsTo(Profile::class);
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product_shop()
    {
        return $this->hasOne(ProductShop::class);
    }

    public function product_shops()
    {
        return $this->hasMany(ProductShop::class);
    }

    public function shops()
    {
        return $this->belongsToMany(Profile::class, 'product_shops', 'product_id', 'shop_id')->withTimestamps();
    }
}
