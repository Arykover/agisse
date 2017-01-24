<?php
                    /* Définition des routes*/
$app->match('/', "GuestController::home"); 
$app->match('/signIn', "GuestController::signIn");
$app->match('/login', "GuestController::login");
$app->match('/identification', "GuestController::identification");
$app->match('/contact', "GuestController::contact");
$app->match('/logOut', "GuestController::logOut");

?>
