<?php

const WW_CODE_PATH = __DIR__ . '/../';
const WW_PATH = __DIR__ . '/../vendor/titar/app/';

require(__DIR__ . '/../vendor/titar/autoload/AutoloaderOfClientCode.php');
require(__DIR__ . '/../vendor/titar/WW.php');

(new ww\App())->run();
