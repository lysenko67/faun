<?php

namespace App\Services\AddOrders;


use App\Models\ProductOrders;
use Illuminate\Support\Facades\DB;

class AddOrders
{
    protected $post;
    protected $order;
    protected $arrQty = [];
    protected $arrTitle = [];
    protected $arrId = [];

    public function __construct($post, $order)
    {
        $this->post = $post;
        $this->order = $order;
    }

    public function create()
    {
        $product_order = new ProductOrders();

        $this->str_post();

        foreach ($this->post as $key => $item) {

            if (preg_match('/id_.+/', $key)) {
                $key = str_replace('id_', '', $key);

                $product_order->create([
                    'order_id' => $this->order->id,
                    'vendor_code' => $key,
                    'qty' => $this->arrQty[$key],
                    'sum' => $item,
                    'title' => $this->arrTitle[$key]
                ]);

            }
        }
    }

    public function update()
    {
        $this->str_post();

        foreach ($this->post as $key => $item) {

            if (preg_match('/id_.+/', $key)) {
                $key = str_replace('id_', '', $key);

                DB::table('product_orders')
                    ->where('id', $this->arrId[$key])
                    ->update([
                        'sum' => $item,
                        'qty' => $this->arrQty[$key],
                    ]);

            }
        }
    }

    protected function str_post()
    {
        foreach ($this->post as $i => $item) {
            if (preg_match('/qty_.+/', $i)) {
                $this->arrQty[str_ireplace('qty_', '', $i)] = $item;
            } else if (preg_match('/title_.+/', $i)) {
                $this->arrTitle[str_ireplace('title_', '', $i)] = $item;
            } else if (preg_match('/id:.+/', $i)) {
                $this->arrId[str_ireplace('id:', '', $i)] = $item;
            }
        }
    }


}
