<?php

require(__DIR__ .'/vendor/autoload.php');

(new Core\Session)->start();

(new Core\Router)->dispatch();