<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = [
        'img',
        'product_id'
    ];
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
}
