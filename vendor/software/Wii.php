<?php

class Wii {

    public static $wiiPaths = [];

    public static function registerWii()
    {
        spl_autoload_register(function ($class) {
            $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if ('wii' . DIRECTORY_SEPARATOR != substr($filePath, 0, 4)) { return false; }
            $filePath = WII_PATH . substr($filePath, 3);
            if (file_exists($filePath)) {
                require $filePath;
                return true;
            }
            return false;
        });
    }

}

Wii::registerWii();
