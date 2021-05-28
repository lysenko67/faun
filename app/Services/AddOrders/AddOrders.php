<?php


namespace App\Services\AddOrders;


class AddOrders
{

    public static function add($post, $client, $model) {

        foreach($post as $qty => $item) {
            if(preg_match('/qty_.+/',  $qty)) {
                $arrQty[str_ireplace('qty_', '', $qty)] = $item;
            } else if(preg_match('/title_.+/',  $qty)) {
                $arrTitle[str_ireplace('title_', '', $qty)] = $item;
            }
        }

        foreach ($post as $key => $item) {
            if(preg_match('/id_.+/',  $key)) {
                $key = str_replace('id_', '', $key);

                $model->create([
                    'client_id' => $client->id,
                    'vendor_code' => $key,
                    'qty' => $arrQty[$key],
                    'sum' => $item,
                    'title' => $arrTitle[$key]
                ]);
            }
        }
    }

}
