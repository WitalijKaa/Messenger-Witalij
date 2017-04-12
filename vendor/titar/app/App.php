<?php

namespace ww;

class App {

    public function run() {
        \WW::$db = new dao\Postgres();

        $cntl = new Controller();
        $cntl->doAction();
    }
}