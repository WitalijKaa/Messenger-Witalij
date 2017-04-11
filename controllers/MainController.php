<?php

namespace controllers;

use models\Person;
use wii\Controller;

class MainController extends Controller {

    public function actionIndex() {
        $pers = new Person();
        $pers->tempEcho();

        $this->render('index');
    }

    public function actionLogin() {
        $this->render('login');
    }
}