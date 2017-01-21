<?php 

require_once __DIR__.'/../src/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

//********************************************Contrôleur connexion*****************//
class GuestController{

    public function __construct(){
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_header.php';
    }
    public function home(){
        //require_once __DIR__.'/../vues/v_connexion.php';
        require_once __DIR__.'/../views/v_home.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }   
}
//********************************************Contrôleur eleve*****************//
class StudentController{
     private $id;
     private $pdo;
     public function init(){
        $this->id = $_SESSION['id'];
        $this->pdo = PdoGsb::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_header.php';
        require_once __DIR__.'/../views/v_home.php';
    }
}

//********************************************Contrôleur Gestionnaire*****************//
class ManagerController{
     private $id;
     private $pdo;
     public function init(){
        $this->id = $_SESSION['id'];
        $this->pdo = PdoGsb::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_header.php';
        require_once __DIR__.'/../views/v_home.php';
    }
}

//********************************************Contrôleur Super User*****************//
class AdministratorController{
     private $id;
     private $pdo;
     public function init(){
        $this->id = $_SESSION['id'];
        $this->pdo = PdoGsb::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_header.php';
        require_once __DIR__.'/../views/v_home.php';
    }
}