<?php

require_once '/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

//********************************************Contrôleur Super User*****************//
class AdministratorController {
    
    private $pdo;
    private $columnsName;
//    private $titles;
        
    public function __construct() {
        ob_start();             // démarre le flux de sortie
        require_once __DIR__ . '/../views/v_header.php';
        require_once __DIR__ . '/../views/v_menu.php';
        $this->pdo = PdoAgisse::getPdoAgisse();
    }
        
    public function home()
    {
        //require_once __DIR__.'/../vues/v_connexion.php';
        require_once __DIR__ . '/../views/v_home.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
        public function manageAffiliation()
    {
        $hide = true;
        $sTable = 'mutuelle';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        require_once __DIR__ . '/../views/v_tabLink.php';
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
    public function manageRegime()
    {
        $hide = true;
        $sTable = 'statut';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        require_once __DIR__ . '/../views/v_tabLink.php';
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
        public function manageNationalite()
    {
        $hide = false;
        $sTable = 'nationalite';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        require_once __DIR__ . '/../views/v_tabLink.php';
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
    public function manageSchool()
    {
        $hide = true;
        $sTable = 'info_etablissmeent';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        $this->hide = true;
        require_once __DIR__ . '/../views/v_tabLink.php';
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
        
    
        
    public function manageApplication()
    {
        
    }
    public function logOut()
    {
        require_once __DIR__ . '/../views/v_logOut.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    public function formDatatable($sTable, $hide)
    {
        
        $this->columnsName = $this->pdo->getColumnsName($sTable);
        $columnsName = $this->columnsName;
        require_once __DIR__ . '/../views/v_formEditDatatable.php';
    }
    public function updateDataTable(Application $app)
    {
           var_dump($_POST['titles']);
            echo'hii';
//        return $app->redirect($app["url_generator"]->generate("GestionEtablissement"));
//            $this->manageSchool();
    }
}
?>
