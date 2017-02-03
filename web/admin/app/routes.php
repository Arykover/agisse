<?php

/* Définition des routes */

//$app->get('/hello/{name}', function($name) use($app) {
//
//	return 'Hello '.$app->escape($name);	
//
//})->value('name','Nobody');


/* Routes AdministratorController*/
$app->match('/', "AdministratorController::administrate");
$app->match('/GestionAffil', "AdministratorController::GestionAffil")
        ->bind('GestionAffil');
$app->match('/GestionRegimes', "AdministratorController::GestionRegimes")
        ->bind('GestionRegimes');
$app->match('/GestionNationalite', "AdministratorController::GestionNationalite")
        ->bind('GestionNationalite');
$app->match('/GestionEtablissement', "AdministratorController::GestionEtablissement")
        ->bind('GestionEtablissement');
$app->match('/Reboot', "AdministratorController::Reboot")
        ->bind('Reboot');
$app->match('/logOut', "AdministratorController::logOut")
        ->bind('logout');

/*
 * $app->get('/redirect', function () use ($app) { 
 * return $app->redirect(dirname("../web/index.php"));
 * });
 */
?>