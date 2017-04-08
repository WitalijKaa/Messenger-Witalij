<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $filePath = APP_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($filePath)) {
                require $filePath;
                return true;
            }
            return false;
        });
    }
}

Autoloader::register();