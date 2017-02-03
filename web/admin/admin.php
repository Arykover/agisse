<?php

// web/index.php
session_start();
require_once __DIR__.'/../../vendor/autoload.php';
date_default_timezone_set('Europe/Paris');
$app = new Silex\Application();
//require_once __DIR__.'/../app/services.php';
require_once dirname(__FILE__).'/app/routes.php';
require_once dirname(__FILE__).'/app/controllerAdmin.php';

$app->run();
$app['debug'] = true;

?>
<br/>
<h2>Bienvenue</h2>
<br/>
Pannel admin:  <a href=""> Cliquez ici ! </a>
