<?php
                    /* Définition des routes*/
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
        ->bind('logout');
$app->match('/profile', "StudentController::profile")
        ->bind('profile');



/*
 * $app->get('/redirect', function () use ($app) { 
 * return $app->redirect(dirname("../web/index.php"));
 * });
 */
?>
