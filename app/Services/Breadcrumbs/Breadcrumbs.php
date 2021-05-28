<?php


namespace App\Services\Breadcrumbs;


class Breadcrumbs
{

    public static function render($category, $product='') {
        $breadcrumbs = "<li class='breadcrumb-item'><a href='/'>Главная</a></li>";
        if($product) {
            $breadcrumbs .= "<li class='breadcrumb-item'><a href='/$category->slug'>$category->title</a></li>";
            $breadcrumbs .= " <li class='breadcrumb-item active' aria-current='page'>$product->title</li>";
        } else {
            $breadcrumbs .= "<li class='breadcrumb-item active' aria-current='page'>$category->title</li>";
        }
        return $breadcrumbs;
    }

}
