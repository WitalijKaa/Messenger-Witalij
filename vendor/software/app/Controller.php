<?php

namespace wii;

class Controller {

    const VIEW_PATH = APP_PATH . 'view/';

    private static $cntlNamespace = 'controllers';
    private static $cntlName = 'Main';

    protected static $defaultActionName = 'index';

    public function doAction() {
        $controllerName = static::$cntlNamespace . '\\' . static::$cntlName . 'Controller';
        $actionName = 'action' . ucfirst(static::$defaultActionName);

        $cntl = new $controllerName();
        $cntl->$actionName();
    }

    protected function render($viewName) {
        require self::VIEW_PATH . $viewName . '.php';
    }
}