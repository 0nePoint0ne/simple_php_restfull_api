<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '/opt/lampp/htdocs/test/vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;


require '../src/routes/products.php';

$app->run();