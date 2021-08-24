<?php


namespace App\Annexe\Ship\Core\Loaders;


class RoutesLoader
{
    private static function getAbsolutePath()
    {
        $path = str_replace('\Ship\Core\Loaders\RoutesLoader.php', '', __FILE__);
        return str_replace('\\', '/', $path);
    }

    public static function getRoutsWeb() {
        $path = self::getAbsolutePath();
        foreach (glob("$path/*/*/*/UI/WEB/Routes/*.php") as $route) {
            include $route;
        }
    }

    public static function getRoutsApi() {
        $path = self::getAbsolutePath();
        foreach (glob("$path/*/*/*/UI/API/Routes/*.php") as $route) {

            include $route;
        }
    }
}
