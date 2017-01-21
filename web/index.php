<?php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';
date_default_timezone_set('Europe/Paris');
$app = new Silex\Application();
require_once __DIR__.'/../app/services.php';
require_once __DIR__.'/../app/roads.php';
require_once __DIR__.'/../app/controllers.php';
$app->run();
$app['debug'] = true;

?>