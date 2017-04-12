<?php

require WW_PATH . '/../WWApp.php';

class WW extends \ww\WWApp {

    public static $wwPaths = [];

    public static function autoloadRegister() {
        spl_autoload_register(function ($class) {
            if (in_array($class, WW::$wwPaths)) {
                // логика для всего что не в папке app
            }

            $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if ('ww' . DIRECTORY_SEPARATOR != substr($filePath, 0, 3)) { return false; }

            $filePath = WW_PATH . substr($filePath, 3);
            if (file_exists($filePath)) {
                require $filePath;
                return true;
            }
            return false;
        });
    }

}

WW::$wwPaths = include WW_PATH . '/../pathsOfOtherVendor.php';
WW::autoloadRegister();
