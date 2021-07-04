<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'category_id',
        'in_stock'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class );
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
