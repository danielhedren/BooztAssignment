<?php

declare(strict_types=1);

require_once('../Config/Config.php');
require_once('../Config/Autoloader.php');

use App\Routing\Router;

$router = new Router();
$router->match($_GET['route'] ?? '');