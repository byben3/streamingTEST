<?php

require '../config/dev.php';
require '../config/autoloader.php';

session_start();

\App\config\Autoloader::register();

$router = new \App\config\router();
$router->run();
