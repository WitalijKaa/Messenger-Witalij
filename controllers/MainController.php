<?php

namespace controllers;

use wii\Controller;

class MainController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }
}