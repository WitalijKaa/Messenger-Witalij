<?php

namespace wii;

class PrettyUrl {

    public function getUrlConfig() {
        $conf = [];
        $request = substr($_SERVER['REQUEST_URI'], 1);
        if ($request) { $conf['action'] = $request; }
        return $conf;
    }
}