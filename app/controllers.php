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
        require_once __DIR__.'/../views/v_menu.php';
    }
    public function home(){
        //require_once __DIR__.'/../vues/v_connexion.php';
        require_once __DIR__.'/../views/v_home.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }   
    
        public function login(){
        require_once __DIR__.'/../views/v_connexion.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    } 
    
     public function logOut(Application $app){
         
        if (isset($_COOKIE[session_name()])) 
	{
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_unset();
	session_destroy();
        require_once __DIR__.'/../views/v_home.php';
        //$app->path(dirname("../web/index.php"));
        $app->redirect($app->path(dirname("../web/index.php")));
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    } 
    
            public function identification(Application $app){
                $login = $_REQUEST['login'];
                $pwd = $_REQUEST['password'];
                $pdo = PdoAgisse::getPdoAgisse();
                $user = $pdo->identification($login,$pwd);
         	if(!is_array( $user)){
                   echo('identifiants ou mot de passe invalide.');
                   require_once __DIR__.'/../views/v_connexion.php';
                }
                else{
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nom'] =  $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['type'] = $user['type'];
                    require_once __DIR__.'/../views/v_home.php';
                    //$app->path(dirname("../web/index.php"));
                    $app->redirect($app->path(dirname("../web/index.php")));
                }
        
                require_once __DIR__.'/../views/v_footer.php';
                $view = ob_get_clean();
                return $view;          
     

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