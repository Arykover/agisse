<?php 

require_once __DIR__.'/../modele/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;﻿

//********************************************Contrôleur visiteur*****************//
class ControleurVisiteur{

    public function __construct(){
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_entete.php';
    }
    
}


//********************************************Contrôleur eleve*****************//
class ControleurEleve{
     private $id;
     private $pdo;
     public function init(){
        $this->id = $_SESSION['id'];
        $this->pdo = PdoGsb::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../vues/v_header.php';
        require_once __DIR__.'/../vues/v_acceuil.php';
        
    }
    
    
}

//********************************************Contrôleur Gestionnaire*****************//
class ControleurGestionnaire{
     private $id;
     private $pdo;
     public function init(){
        $this->id = $_SESSION['id'];
        $this->pdo = PdoGsb::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../vues/v_header.php';
        require_once __DIR__.'/../vues/v_acceuil.php';
        
    }
    
    
}

//********************************************Contrôleur Super User*****************//
class ControleurSU{
     private $id;
     private $pdo;
     public function init(){
        $this->id = $_SESSION['id'];
        $this->pdo = PdoGsb::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../vues/v_header.php';
        require_once __DIR__.'/../vues/v_acceuil.php';
        
    }
    
    
}