<?php

/* Définition des routes */

//$app->get('/hello/{name}', function($name) use($app) {
//
//	return 'Hello '.$app->escape($name);	
//
//})->value('name','Nobody');


/* Routes AdministratorController*/
$app->match('/', "AdministratorController::home");
$app->match('/Home', "AdministratorController::home")
        ->bind('Home');
$app->match('/GestionAffil', "AdministratorController::manageAffiliation")
        ->bind('GestionAffil');
$app->match('/GestionRegimes', "AdministratorController::manageRegime")
        ->bind('GestionRegimes');
$app->match('/GestionNationalite', "AdministratorController::manageNationalite")
        ->bind('GestionNationalite');
$app->match('/GestionEtablissement', "AdministratorController::manageSchool")
        ->bind('GestionEtablissement');
$app->match('/Reboot', "AdministratorController::Reboot")
        ->bind('Reboot');
$app->match('/logOut', "AdministratorController::logOut")
        ->bind('logout');
$app->match('/updateDataTable', "AdministratorController::updateDataTable")
        ->bind('updateDataTable');
$app->match('/deleteDataTable', "AdministratorController::deleteDataTable")
        ->bind('deleteDataTable');

/*
 * $app->get('/redirect', function () use ($app) { 
 * return $app->redirect(dirname("../web/index.php"));
 * });
 */
?>
