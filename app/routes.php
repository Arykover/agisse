<?php
                    /* Définition des routes*/
$app->match('/', "GuestController::home")
        ->bind('homepage'); 
$app->match('/signIn', "GuestController::signIn")
        ->bind('signin');
$app->match('/login', "GuestController::login")
        ->bind('login');
$app->match('/identification', "GuestController::identification")
        ->bind('identification');
$app->match('/contact', "GuestController::contact")
        ->bind('contact');
$app->match('/logOut', "GuestController::logOut")
        ->bind('logout');


/*
 * $app->get('/redirect', function () use ($app) { 
 * return $app->redirect(dirname("../web/index.php"));
 * });
 */
?>
