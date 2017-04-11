<?php

namespace wii;

class Controller {

    const VIEW_PATH = APP_PATH . 'view/';

    private $cntlNamespace = 'controllers';
    private $cntlName = 'Main';

    protected $actionName = 'index';

    public function __construct($config = []) {
        if (array_key_exists('action', $config)) {
            $this->actionName = $config['action'];
        }
    }

    public function doAction() {
        $controllerName = $this->cntlNamespace . '\\' . $this->cntlName . 'Controller';

        $urlConfig = (new PrettyUrl())->getUrlConfig();

        $cntl = new $controllerName($urlConfig);
        $actionName = 'action' . ucfirst($cntl->actionName);
        $cntl->$actionName();
    }

    protected function render($viewName, $viewAttrs = []) {
        foreach ($viewAttrs as $attrKey => $attrVal) {
            global $$attrKey;
            $$attrKey = $attrVal;
        }

        require self::VIEW_PATH . $viewName . '.php';
    }
}