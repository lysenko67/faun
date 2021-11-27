<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\Models;

use App\Annexe\containers\ShopSection\ShopCategories\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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
        return $this->hasMany(ProductImage::class);
    }

    public function gltfFile()
    {
        return $this->hasMany(ProductGltf::class);
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
