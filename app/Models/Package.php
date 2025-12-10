<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery; // ← WAJIB DITAMBAHKAN

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'price',
        'image',
        'description',
        'is_featured',
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'package_id');
    }
}
