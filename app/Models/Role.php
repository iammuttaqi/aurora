<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
    ];

    public static function idsInArray($type)
    {
        return self::where('type', $type)->select('id')->pluck('id')->toArray();
    }

    public static function idsInCommaSeparated($type)
    {
        return self::where('type', $type)->select('id')->implode('id', ',');
    }

    public static function slugsInArray($type)
    {
        return self::where('type', $type)->select('slug')->pluck('slug')->toArray();
    }

    public static function slugsInCommaSeparated($type)
    {
        return self::where('type', $type)->select('slug')->implode('slug', ',');
    }
}
