<?php

/* Définition des routes */
//$frontend = $app['controllers_factory'];
//$app->get('/hello/{name}', function($name) use($app) {
$app->get('/hello/{name}', function($name) use($app) {

	return 'Hello '.$app->escape($name);	

})->value('name','Nobody');


/* Routes Guest controller*/
$app->match('/', "GuestController::home")
        ->bind('homepage');
$app->match('/home', "GuestController::home");
$app->match('/signIn', "GuestController::signIn")
        ->bind('signin');
$app->match('/inscription', "GuestController::inscription")
        ->bind('inscription');
$app->match('/login', "GuestController::login")
        ->bind('login');
$app->match('/identification', "GuestController::identification")
        ->bind('identification');
$app->match('/contact', "GuestController::contact")
        ->bind('contact');
$app->match('/logOut', "GuestController::logOut")
        ->bind('logOut');

/* Routes Student controller*/
$app->match('/profile', "StudentController::profile")
        ->bind('profile');
$app->match('/editUserProfile', "StudentController::editUserProfile")
        ->bind('editUserProfile');
$app->match('/Fiche', "StudentController::Fiche")
        ->bind('Fiche');
$app->match('/modifFiche', "StudentController::modifFiche")
        ->bind('modifFiche');
$app->match('/sauvFiche', "StudentController::sauvFiche")
        ->bind('sauvFiche');
$app->match('/MailFiche', "StudentController::MailFiche")
        ->bind('MailFiche');

/* Routes manager controller*/
$app->match('/GestionEleves', "ManagerController::GestionEleves")
        ->bind('GestionEleves');
$app->match('/GestionFiches', "ManagerController::GestionFiches")
        ->bind('GestionFiches');
$app->match('/GestionDisciplines', "ManagerController::GestionDisciplines")
        ->bind('GestionDisciplines');
$app->match('/GestionProfil', "ManagerController::GestionProfil")
        ->bind('GestionProfil');
$app->match('/editDiscipline', "ManagerController::editDiscipline")
        ->bind('editDiscipline');
$app->match('/modifDiscipline', "ManagerController::modifDiscipline")
        ->bind('modifDiscipline');


/*
 * $app->get('/redirect', function () use ($app) { 
 * return $app->redirect(dirname("../web/index.php"));
 * });
 */
?>