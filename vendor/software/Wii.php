<?php

require WII_PATH . '/../WiiApp.php';

class Wii extends \wii\WiiApp {

    public static $wiiPaths = [];

    public static function registerWii()
    {
        spl_autoload_register(function ($class) {
            if (in_array($class, Wii::$wiiPaths)) {
                // логика для всего что не в папке app
            }

            $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if ('wii' . DIRECTORY_SEPARATOR != substr($filePath, 0, 4)) { return false; }


            $filePath = WII_PATH . substr($filePath, 4);
            if (file_exists($filePath)) {
                require $filePath;
                return true;
            }
            return false;
        });
    }

}

Wii::$wiiPaths = include WII_PATH . '/../paths.php';
Wii::registerWii();
