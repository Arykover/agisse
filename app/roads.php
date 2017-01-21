<?php
                    /* Définition des routes*/
$app->match('/', "GuestController::home"); 
$app->match('/signIn', "GuestController::signIn");
$app->match('/logIn', "GuestController::logIn");
$app->match('/contact', "GuestController::contact");
$app->match('/logOut', "GuestController::logOut");

?>
