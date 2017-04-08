<?php

namespace wii;

class App {

    public function run() {
        \Wii::$db = new dao\Postgres();

        $cntl = new Controller();
        $cntl->doAction();
    }
}