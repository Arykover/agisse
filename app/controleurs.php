<?php 

require_once __DIR__.'/../modele/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;﻿

//********************************************Contrôleur connexion*****************//
class ControleurVisiteur{

    public function __construct(){
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_entete.php';
    }
    
}