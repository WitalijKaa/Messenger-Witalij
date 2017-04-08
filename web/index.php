<?php

const APP_PATH = __DIR__ . '/../';
const WII_PATH = __DIR__ . '/../vendor/software/app/';

require(__DIR__ . '/../vendor/autoload/Autoloader.php');
require(__DIR__ . '/../vendor/software/Wii.php');

(new wii\App())->run();
(new view\TempView())->tempEcho();