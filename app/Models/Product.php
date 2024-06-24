<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price');,
        'main_image',
        'additional_images',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
