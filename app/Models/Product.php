<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'price',
        'category_id',
        'additional',
        'seo_title',
        'seo_description',
        'image',
        'similar_products',
        'status',
        'rate'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id')->get();
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->get();
    }
}