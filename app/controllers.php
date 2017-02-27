<?php

require_once __DIR__ . '/class.pdoAgisse.php';

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

//********************************************Contrôleur connexion*****************//
class GuestController {

    public function __construct() {
        ob_start();             // démarre le flux de sortie
        require_once __DIR__ . '/../web/views/v_header.php';
        require_once __DIR__ . '/../web/views/v_menu.php';
    }

    public function home() {
        //require_once __DIR__.'/../vues/v_connexion.php';
        require_once __DIR__ . '/../web/views/v_home.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }

    public function login() {
        require_once __DIR__ . '/../web/views/v_connexion.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }

    public function SignIn() {
        require_once __DIR__ . '/../web/views/v_signin.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }

    public function inscription(Application $app) {
        $Lname = strtolower($_REQUEST['Lname']);
        $Fname = strtolower($_REQUEST['Fname']);
        $mail = $_REQUEST['email'];
        $pwd = $_REQUEST['password'];
        $pdo = PdoAgisse::getPdoAgisse();

        // appel de la fonction determinant si ce mail est deja utilisé.

        if ($pdo->VerifMail($mail)) {

            // creation du login avec nom_initialePrenom 
            // et un chiffre si un utilisateur avec le meme login existe
            // select count(*) from comptes where nom = "gestion" and substring(prenom,1,1) = "g"

            $login = $Lname . "_" . $Fname[0] . $pdo->nbUser($Lname, $Fname[0]);

            // appel de la fonction d'insertion dans la base de données
            $pdo->insertUser($login, $pwd, $Lname, $Fname, $mail, 'ELEVE');

            return $app->redirect($app["url_generator"]->generate("homepage"));
        } else {
            echo('Cet e-mail est déjà utilisé');
            require_once __DIR__ . '/../web/views/v_signIn.php';
        }

        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean();
        return $view;
    }

    public function logOut(Application $app) {
        $app['services']->logout($app);
        ob_get_clean(); // récupère le contenu du flux et le vide
        return $app->redirect($app["url_generator"]->generate("homepage")); 
    }

    public function identification(Application $app) {
        $login = $_REQUEST['login'];
        $pwd = $_REQUEST['password'];
        $pdo = PdoAgisse::getPdoAgisse();
        $user = $pdo->identification($login, $pwd);
        if (!is_array($user)) {
            echo('identifiants ou mot de passe invalide.');
            require_once __DIR__ . '/../web/views/v_connexion.php';
        } else {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['type'] = $user['type'];
            $_SESSION['login'] = $user['login'];
            return $app->redirect($app["url_generator"]->generate("homepage"));
        }

        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean();
        return $view;
    }

}

//********************************************Contrôleur eleve*****************//
class StudentController {

    private $pdo;

    public function init() {
        $this->pdo = PdoAgisse::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__ . '/../web/views/v_header.php';
        require_once __DIR__ . '/../web/views/v_menu.php';
    }

    
    public function profile() {
        $this->init();
        $userInfo = $this->pdo->getUserProfile($_SESSION['id']);
        //Récup les data du compte dans la bdd à partir de l'id de l'user connecté
        //PersonalInfos = $this->pdo->getPersonalInfos($_SESSION['id']Account);
        //On affiche la vue avec le formulaire complété grâce aux data récup ds la bdd
        require_once __DIR__ . '/../web/views/v_profile.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
    public function Auth(Application $app) {
        // Verification des autorisations eleve
//        if (!isset($_SESSION['type']) || $_SESSION['type'] != 'ELEVE' || $_SESSION['type'] != 'GESTION') {
//                $app['services']->logout($app);
//                echo "vous n'etes pas connecté";
//                ob_get_clean(); // récupère le contenu du flux et le vide
//                exit();          
//        }
    }
    
        public function Fiche(Application $app) {
        $this->Auth($app);
        $this->init();
        if($_SESSION['type'] == 'ELEVE'){
            $id = $_SESSION['id'];
        }
        else{
            $id = $_REQUEST['id'];
        }
        $pdo = PdoAgisse::getPdoAgisse();
        $fiche = $this->pdo->getFiche($id);
        $etat = $this->pdo->getEtats();
        //Récup les data du compte dans la bdd à partir de l'id de l'user connecté
        //PersonalInfos = $this->pdo->getPersonalInfos($_SESSION['id']Account);
        //On affiche la vue avec le formulaire complété grâce aux data récup ds la bdd
        require_once __DIR__ . '/../web/views/v_fiche.php';
        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
     public function MailFiche(Application $app) {
        $this->Auth($app);
        $this->pdo = PdoAgisse::getPdoAgisse();
        ob_start();
        if($_SESSION['type'] == 'ELEVE'){
            $id = $_SESSION['id'];
        }
        else{
            $id = $_REQUEST['id'];
        }
        $fiche = $this->pdo->getFiche($id);
        //Récup les data du compte dans la bdd à partir de l'id de l'user connecté
        //PersonalInfos = $this->pdo->getPersonalInfos($_SESSION['id']Account);
        //On affiche la vue avec le formulaire complété grâce aux data récup ds la bdd
        require_once __DIR__ . '/../web/views/v_editerFiche.php';
        $content = ob_get_clean();
        ob_end_clean();
        $pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(15, 5, 15, 5)); 
        $pdf->writeHTML($content); 
        
        $body = 'Votre fiche de securiteé sociale';
        $user = $this->pdo->getUserProfile($id);
        $app['services']->sendMail($body, $user['mail'] ,$user['nom']." ".$user['prenom'], 'Fiche Securite sociale', $pdf);
        

               return $app->redirect($app["url_generator"]->generate("Fiche"));
    }
    
     public function sauvFiche(Application $app) {
         
        $this->Auth($app);
        $this->init();
        $id = $_REQUEST['id'];
        
        
        
        if(!empty($_REQUEST['civilite'])){$param['civilite'] = htmlentities($_REQUEST['civilite']);}

        if(!empty($_REQUEST['nomNaiss'])){$param['nom_naiss'] = htmlentities($_REQUEST['nomNaiss']);}

        if(!empty($_REQUEST['communeNaiss'])){$param['commune_naiss'] = htmlentities($_REQUEST['communeNaiss']);}

        if(!empty($_REQUEST['deptNaiss'])){$param['dept_naiss'] = htmlentities($_REQUEST['deptNaiss']);}
        
        if(!empty($_REQUEST['dateNaiss'])){$param['date_naiss'] = htmlentities($_REQUEST['dateNaiss']);
            if(!empty($_REQUEST['numSecu'])){
                
                // controle php du numero de secu avec la date de naissance
                
                if(substr($_REQUEST['numSecu'],1,2) == substr($_REQUEST['dateNaiss'],2,2)){
                     $param['num_secu'] = htmlentities($_REQUEST['numSecu']);
                }
                else{die();}
            }
        }

        if(!empty($_REQUEST['discipline'])){$param['discipline'] = htmlentities($_REQUEST['discipline']);}

        if(!empty($_REQUEST['nation'])){$param['nationalite'] = htmlentities($_REQUEST['nation']);}

        if(!empty($_REQUEST['adresse'])){$param['adresse'] = htmlentities($_REQUEST['adresse']);}

        if(!empty($_REQUEST['CP'])){$param['cp'] = htmlentities($_REQUEST['CP']);}

        if(!empty($_REQUEST['adresseComp'])){$param['comp_adresse'] = htmlentities($_REQUEST['adresseComp']);}

        if(!empty($_REQUEST['ville'])){$param['ville'] = htmlentities($_REQUEST['ville']);}
 
        if(!empty($_REQUEST['telephone'])){$param['telephone'] = htmlentities($_REQUEST['telephone']);}

        if(!empty($_REQUEST['centre'])){$param['mutuelle'] = htmlentities($_REQUEST['centre']);}

        if(!empty($_REQUEST['statut'])){$param['statut'] = htmlentities($_REQUEST['statut']);}

        if(!empty($_REQUEST['commEtudiant'])){$param['observations_eleve'] = htmlentities($_REQUEST['commEtudiant']);}

        if(!empty($_REQUEST['commGestionnaire'])){$param['observations_gest'] = htmlentities($_REQUEST['commGestionnaire']);}


        $this->pdo->updateFiche($param,$id);
       
        

        ob_get_clean(); // récupère le contenu du flux et le vide
        return $app->redirect($app["url_generator"]->generate("Fiche"));
    }
    
    public function modifFiche(Application $app) {
        $this->Auth($app);
        $this->init();
        if($_SESSION['type'] == 'ELEVE'){
            $id = $_SESSION['id'];
        }
        else{
            $id = $_REQUEST['id'];
        }
        $pdo = PdoAgisse::getPdoAgisse();
        $fiche = $this->pdo->getFiche($id);
        $nationalites = $this->pdo->getNationalites();
        $centres = $this->pdo->getCentres();
        $disciplines = $this->pdo->getDisciplines();
        $statuts = $this->pdo->getStatuts();
        //Récup les data du compte dans la bdd à partir de l'id de l'user connecté
        //PersonalInfos = $this->pdo->getPersonalInfos($_SESSION['id']Account);
        //On affiche la vue avec le formulaire complété grâce aux data récup ds la bdd
        require_once __DIR__ . '/../web/views/v_modifFiche.php';
        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    

    
    public function editUserProfile(Application $app) {
        $this->Auth($app);
        $this->init();
        $userInfo = $this->pdo->getUserProfile($_SESSION['id']);
        $nom = strtolower($_REQUEST['lastName']);
        $prenom = strtolower($_REQUEST['firstName']);
        $pwdOld = $_REQUEST['passwordOld'];
        $pdo = PdoAgisse::getPdoAgisse();
        
        // si la modification est faite par l'eleve 
        
        if($_SESSION['type'] == 'ELEVE'){
                
            $id = $_SESSION['id'];
                // appel de la fonction determinant si l'ancien mdp correspond au compte connecté
                if ($pdo->hashCheck($_SESSION['login'], $pwdOld)) {
                    //mise à jour du nom et du prénom
                    $pdo->updateUserNames($id, $nom, $prenom);
                    //verifier que le checkbox pour modifier le mail est coché,
                    //si c'est le cas, mettre à jour le nouveau mail entré
                    if (!empty($_REQUEST['togMail'])) {
                        $mail = $_REQUEST['mail'];
                        $pdo->updateUserMail($id, $mail);
                    }
                    //verifier que le checkbox pour modifier le mot de passe est coché, 
                    //si c'est le cas, mettre à jour le nouveau mail entré
                    if (!empty($_REQUEST['togPwd'])) {
                        $pwdNew = $_REQUEST['password'];
                        $pdo->updateUserPwd($id, $_SESSION['login'], $pwdNew);
                    }
                    echo('Les modifications ont bien été enregistrées !');
                } 
                else {
                    echo('Mot de passe actuel invalide !');
                }
        }
        
        // Si la modification est faite par un gestionnaire
        
        else if($_SESSION['type'] == 'GESTION'){
                    
                    $id = $_REQUEST['id'];
                    $pdo->updateUserNames($id, $nom, $prenom);
                    //verifier que le checkbox pour modifier le mail est coché,
                    //si c'est le cas, mettre à jour le nouveau mail entré
                    $mail = $_REQUEST['mail'];
                    $pdo->updateUserMail($id, $mail);
            
        }
            if(isset($_REQUEST['pwdGen'])){
                if($_REQUEST['pwdGen']){
                    $pwd = $app['services']->pwdGenerator();
                    $user = $this->pdo->getUserProfile($id);
                    $body = '@Gisse
                            Un nouveau mot de passe pour votre compte a été generé, voici vos identifiants :
                            Identifiant : '.$user['login'].' 
                            Mot de passe : '.$pwd;
                            
                    
                    $app['services']->sendMail($body, $user['mail'] ,$user['nom']." ".$user['prenom'], 'Generatio nde mot de passe', false);
                    $pdo->updateUserPwd($id, $user['login'], $pwd);
            }
            
        }
        require_once __DIR__ . '/../web/views/v_profile.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }

}

//********************************************Contrôleur Gestionnaire*****************//
class ManagerController {

    private $id;
    private $pdo;

    public function init() {
        $this->pdo = PdoAgisse::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        require_once __DIR__ . '/../web/views/v_header.php';
        require_once __DIR__ . '/../web/views/v_menu.php';
    }

    public function Auth(Application $app) {
        if (!isset($_SESSION['type']) || $_SESSION['type'] != 'GESTION' ) {
                $app['services']->logout($app);
                echo "vous n'etes pas connecté";
                ob_get_clean(); // récupère le contenu du flux et le vide
                exit(); 
        }
    }

    
           public function GestionEleves(Application $app) {
        $datatable = true;
        $this->Auth($app);
        $this->init();

        
        $data = $this->pdo->getComptesEleves();
        //Récup les data des compte eleves dans la bdd 
        

//        require_once __DIR__ . '/../web/views/v_tabLink.php';
//        require_once __DIR__ . '/../web/views/v_dataTable.php';
        require_once __DIR__ . '/../web/views/v_gestionEleve.php';
        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
               public function GestionClasses(Application $app) {
        $datatable = true;
        $this->Auth($app);
        $this->init();

        
        $data = $this->pdo->getDisciplines();
        //Récup les data des compte eleves dans la bdd 

        require_once __DIR__ . '/../web/views/v_gestionEleve.php';
        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
    public function GestionFiches(Application $app) {
        $datatable = true;
        $this->Auth($app);
        $this->init();

        
        $data = $this->pdo->getFiches();
        //Récup les data des compte eleves dans la bdd 
      
        require_once __DIR__ . '/../web/views/v_gestionFiches.php';
        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
       public function GestionProfil(Application $app) {
        $this->Auth($app);
        $this->init();

            $id = $_REQUEST['id'];
        
        $userInfo = $this->pdo->getUserProfile($id);
        //Récup les data du compte dans la bdd à partir de l'id de l'user connecté
        //PersonalInfos = $this->pdo->getPersonalInfos($_SESSION['id']Account);
        //On affiche la vue avec le formulaire complété grâce aux data récup ds la bdd
        require_once __DIR__ . '/../web/views/v_profile.php';
        require_once __DIR__ . '/../web/views/v_footer.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
}

//********************************************Contrôleur Super User*****************//
class AdministratorController {

    private $id;
    private $pdo;

    public function init() {
        $_SESSION['id'] = $_SESSION['id'];
        $this->pdo = PdoAgisse::getPdoAgisse();
        ob_start();             // démarre le flux de sortie
        Auth();
        require_once __DIR__ . '/../web/views/v_header.php';
        require_once __DIR__ . '/../web/views/v_home.php';
    }

    public function Auth(Application $app) {
        if ($_SESSION['type'] != 1) {
            return $app->redirect($app["url_generator"]->generate("logout"));
        }
    }

}

?>