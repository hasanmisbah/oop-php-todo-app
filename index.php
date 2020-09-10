<?php

use App\Core\Request;
use App\Core\Router;

require  'vendor/autoload.php';

$router = Router::load('routes.php');
$router->direct(Request::uri(), Request::method());