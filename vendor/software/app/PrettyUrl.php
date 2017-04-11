<?php

namespace wii;

class PrettyUrl {

    public function getUrlConfig() {
        // пока что наш фрейм поддерживает простые красивые ссылки типа домен.com/login
        // где страница логин превращается в action параметр конфигурации PrettyUrl
        $conf = [];
        $request = substr($_SERVER['REQUEST_URI'], 1);
        if ($request) { $conf['action'] = $request; }
        return $conf;
    }
}