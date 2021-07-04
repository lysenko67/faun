<?php


namespace App\Repositories;


class CartRepository
{
    protected $id;
    protected $qty_product;
    protected $price;
    protected $product_slug;
    protected $category_slug;
    protected $title;
    protected $img;

    public function __construct($product = [], $qty_product = 1)
    {
        $this->id = $product['id'];
        $this->price = $product['price'];
        $this->qty_product = $qty_product;
        $this->product_slug = $product['slug'];
        $this->category_slug = $product['category']['slug'];
        $this->title = $product['title'];
        $this->img = array_shift($product['images'])['img'];
    }

    protected function addProduct($price = '', $qty_product = 1)
    {
        return [
            'id' => $this->id,
            'qty_product' => $qty_product,
            'price' => $price,
            'product_slug' => $this->product_slug,
            'category_slug' => $this->category_slug,
            'title' => $this->title,
            'img' => $this->img
        ];
    }

    public function addToCart()
    {
        $this->addArrCart();

        $this->addArrResultQty();

        $this->addArrResultSum();

        session()->save();
//        dd(session()->get('cart'), session()->get('result'));
    }

    protected function addArrCart()
    {
        if (session()->has("cart.$this->id")) {
            $value = session()->get("cart.$this->id.qty_product");
            $this->price = $this->price * ($value + $this->qty_product);
            $this->qty_product = $value + $this->qty_product;

            session()->put("cart.$this->id", $this->addProduct($this->price, $this->qty_product));
            damp($this->qty_product, $value, session()->get('cart'));
        } else {
            session()->put("cart.$this->id", $this->addProduct($this->price, $this->qty_product));
        }
    }

    protected function addArrResultQty()
    {
        if (session()->has('result.qty')) {
            $value = session()->get("result.qty");
            session()->put('result.qty', $value + $this->qty_product);
        } else {
            session()->put('result.qty', $this->qty_product);
        }
    }

    protected function addArrResultSum()
    {
        if (session()->has('result.sum')) {
            $value = session()->get("result.sum");
            session()->put('result.sum', $value + $this->price * $this->qty_product);
        } else {
            session()->put('result.sum', $this->price * $this->qty_product);
        }
    }

}
