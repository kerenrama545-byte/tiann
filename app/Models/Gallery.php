<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Package; // <-- Tambahkan ini

class Gallery extends Model
{
    protected $fillable = [
        'package_id',
        'title',
        'image',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
