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
        return $this->belongsTo(Category::class );
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


//    public static function uploadImage($request, $image = null) {
//        if($request->hasFile('img')) {
//            if($image) {
//                Storage::delete($image);
//            }
//            $folder = date('Y-m-d');
//            return $request->file('img')->store("images/{$folder}");
//        }
//        return null;
//    }

//    public function getImage() {
//        if(!$this->thumbnail) {
//            return asset("uploads/no-image.png");
//        }
//        return asset("uploads/{$this->thumbnail}");
//    }
}
