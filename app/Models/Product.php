<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected function titleWrapped(): Attribute
    {
        return Attribute::make(
            get: fn () => str()->wordWrap($this->title, 30, '<br>'),
        );
    }

    protected function image(): Attribute
    {
        $default_image = Vite::asset('resources/images/no-image.png');

        return Attribute::make(
            // set: fn (?string $value) => $value ?? fake()->imageUrl,
            get: fn (?string $value) => $value && file_exists($value) ? $value : $default_image,
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

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product_profiles()
    {
        return $this->hasMany(ProductProfile::class);
    }

    public function product_customers()
    {
        return $this->hasMany(ProductCustomer::class);
    }
}
