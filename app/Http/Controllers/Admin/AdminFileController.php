<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);
        $files = $request->file('files');

        $this->addProductImage($files, $product->id);

        return response()->json($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if(isset($data['img_name'])) {
            $images = ProductImage::where('product_id', $id)->get();
            foreach ($images as $item) {
                if($data['img_name'] === $item['img']) {
                    Storage::delete('public/images/' . $id .'/'. $item->img);
                    $item->delete();
                    return response()->json('delete');
                }
            }
        } else {
            if(isset($data['files'])) {
                $files = $request->file('files');
                $this->addProductImage($files, $id);
            }
            Product::find($id)->update($data);
        }

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addProductImage($files, $id) {
        foreach ($files as $file) {
            $path = $file->store('public/images/' . $id);
            $img = explode('/', $path)[3];
            $product_image =[
                'img' => $img,
                'product_id' => $id
            ];
            ProductImage::create($product_image);
        }
    }
}
