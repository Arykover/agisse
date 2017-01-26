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
    
     public function SignIn(){
        require_once __DIR__.'/../views/v_signin.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    } 
    
     public function inscription(Application $app){
                $Lname = strtolower($_REQUEST['Lname']);
                $Fname = strtolower($_REQUEST['Fname']);
                $mail = $_REQUEST['email'];
                $pwd = $_REQUEST['password'];
                $pdo = PdoAgisse::getPdoAgisse();
                
                // appel de la fonction determinant si ce mail est deja utilisé.
                
                if($pdo->VerifMail($mail)){

                // creation du login avec nom_initialePrenom 
                // et un chiffre si un utilisateur avec le meme login existe
                    // select count(*) from comptes where nom = "gestion" and substring(prenom,1,1) = "g"
                
                $login = $Lname."_".$Fname[0].$pdo->nbUser($Lname,$Fname[1]);
                
                // appel de la fonction d'insertion dans la base de données
                $pdo->insertUser($login,$pwd,$Lname,$Fname,$mail,3);
                
                return $app->redirect($app["url_generator"]->generate("homepage"));
                }
         	
                else{
                   echo('Cet e-mail est déjà utilisé');
                   require_once __DIR__.'/../views/v_signIn.php';
                    
                }
        
                require_once __DIR__.'/../views/v_footer.php';
                $view = ob_get_clean();
                return $view;          
     

    }
    
     public function logOut(Application $app){
         
        if (isset($_COOKIE[session_name()])) 
	{
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_unset();
	session_destroy();
        return $app->redirect($app["url_generator"]->generate("homepage"));
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
                    return $app->redirect($app["url_generator"]->generate("homepage"));
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
        $this->pdo = PdoAgisse::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__.'/../views/v_header.php';
        require_once __DIR__.'/../views/v_menu.php'; 
     }
    public function profile(){
        $this->init();
        //Récup les data du compte dans la bdd à partir de l'id de l'user connecté
        //PersonalInfos = $this->pdo->getPersonalInfos($this->idAccount);
        //On affiche la vue avec le formulaire complété grâce aux data récup ds la bdd
        require_once __DIR__.'/../views/v_profile.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }  
    public function editInfosPersos()
    {
        //PersonalInfos = $this->pdo->getPersonalInfos($this->idAccount);
        //Récup les infos des champs du formulaires
        $lastName = $request->get('lastName');
        $firstName = $request->get('firstName');
        $mail = $request->get('mail');
        $pwd = $request->get('password');
        $pwdCheck = $request->get('passwordCheck');
        
        require_once __DIR__.'/../views/v_profile.php';
        
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
        Auth();
        require_once __DIR__.'/../views/v_header.php';
        require_once __DIR__.'/../views/v_home.php';
    }
    
                public function Auth(){
        if($_SESSION['type']!=2 || $_SESSION['type']!=1 ){
            return $app->redirect($app["url_generator"]->generate("logout"));
        }    
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
        Auth();
        require_once __DIR__.'/../views/v_header.php';
        require_once __DIR__.'/../views/v_home.php';
    }
    
                public function Auth(){
            if($_SESSION['type']!=1){
            return $app->redirect($app["url_generator"]->generate("logout"));
        }    
    } 
}
