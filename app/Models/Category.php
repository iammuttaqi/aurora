<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];

    protected function profilesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => Profile::where('category_ids', 'LIKE', '%' . $this->id . '%')->count(),
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn () => $this->generateUniqueSlug(),
        );
    }

    protected function generateUniqueSlug()
    {
        if (!$this->slug) {
            $slug  = str()->slug($this->title);
            $count = 2;

            while ($this->where('slug', $slug)->exists()) {
                $slug = str()->slug($this->title) . '-' . $count++;
            }

            return $slug;
        }

        return $this->slug;
    }
}
