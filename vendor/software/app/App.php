<?php

namespace wii;

class App {

    public function run() {
        $cntl = new Controller();
        $cntl->doAction();
    }
}