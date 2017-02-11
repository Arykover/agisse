<?php


use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\Debug;
// web/index.php
session_start();
require_once __DIR__.'/../vendor/autoload.php';
date_default_timezone_set('Europe/Paris');
$app = new Silex\Application();
require_once __DIR__.'/../app/services.php';
require_once __DIR__.'/../app/routes.php';
require_once __DIR__.'/../app/controllers.php';
$app['debug'] = true;
$app->run();
?>