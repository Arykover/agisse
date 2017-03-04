<?php

session_start();
require_once __DIR__.'/../../vendor/autoload.php';
date_default_timezone_set('Europe/Paris');
$app = new Silex\Application();
require_once __DIR__.'/app/servicesAdmin.php';
require_once dirname(__FILE__).'/app/routes.php';
require_once dirname(__FILE__).'/app/ControlleurAdministrateur.php';

$app->run();
$app['debug'] = true;

?>
